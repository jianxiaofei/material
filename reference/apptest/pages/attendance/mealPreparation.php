<!--
 	模块： 误餐报备
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>误餐报备</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			html,
			body,
			.mui-content {
				background-color: #FFF;
				background: url(../../img/icon_list.png) no-repeat center center;
				-webkit-background-size: cover;
			    -moz-background-size: cover;
			    -o-background-size: cover;
			    background-size: cover;
			    filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../img/icon_list.png', sizingMethod='scale');/* for < ie9 */
			}
			.content-block{
				margin-top: 15%;
				margin-left: 13%;
				margin-right: 13%;
				background-color: #FFF;
				border: 1px solid #FFF;
				border-radius: 20px;
			}
			.mui-table-view img{
				width: 4rem;
				border-radius: 50%;
			}
			.mui-table-view-cell span.circle{
				width: 40px;
				height: 40px;
				border-radius: 50%;
				background-color: #ace3f7;
				display: inline-block;
				line-height: 40px;
				text-align: center;
				color: #FFF;
			}
			.exist{
				color: #888;
				margin-left: 4rem;
				font-size: .8rem;
			}
			textarea:-ms-input-placeholder {
			    color: #888;
			    font-size: .8rem;
			}
			
			textarea::-webkit-input-placeholder {
			    color: #888;
			    font-size: .8rem;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-fullscreen">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<div class="content-block">
						<div class="mui-content-padded" style="text-align: center;">
							<p style="font-weight: bold;color: #888;">请选择误餐时间</p>
						</div>
						<div class="mui-content-padded" style="text-align: center;margin-bottom: 10px;">
							<p style="font-weight: bold;color: #888;" id="date"></p>
						</div>
						<ul class="mui-table-view">
							<li class="mui-table-view-cell">
								<span class="circle">
									早餐
								</span>
								<span class="exist mui-hidden" id="exist-morning">已报备</span>
								<div class="mui-switch mui-switch-mini" id="morning-switch">
									<div class="mui-switch-handle"></div>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<span class="circle">
									中餐
								</span>
								<span class="exist mui-hidden" id="exist-noon">已报备</span>
								<div class="mui-switch mui-switch-mini" id="noon-switch">
									<div class="mui-switch-handle"></div>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<span class="circle">
									晚餐
								</span>
								<span class="exist mui-hidden" id="exist-afternoon">已报备</span>
								<div class="mui-switch mui-switch-mini" id="afternoon-switch">
									<div class="mui-switch-handle"></div>
								</div>
							</li>
						</ul>
						<div class="mui-content-padded">
							<div class="mui-input-row" style="color: #888;font-size: 1rem;">
								<label>事由</label>
								<textarea id="content" cols="*" rows="5" placeholder="请输入事由(必填)"></textarea>
							</div>
						</div>
						<div class="mui-content-padded" style="text-align: center;margin-top: 20px;">
							<button id="addMealPreparation" type="button" class="mui-btn" style="width: 95%;height: 36px;background-color: #1AC2FF;color: #FFF;" onclick="return false;">提交</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="../../js/mui.min.js "></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init();
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
		var policenum = window.javaInterface.getPolicenum();//"005566";//
		var token = window.javaInterface.getToken();//"6C4BB022-1F6C-FD33-9E92-D8C0AB09013F";//
		
		(function($) {
			var flag = false;
			function refreshPage(){
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'listMissMealPrep',
						policenum:policenum
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'GET',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							var meal = data.result;
							document.getElementById('date').innerHTML = meal.date;
							if(parseInt(meal.morning)>0){
								document.getElementById('exist-morning').classList.remove('mui-hidden');
								document.getElementById('morning-switch').classList.add('mui-active');
								document.getElementById('morning-switch').classList.add('mui-disabled');
							}
							if(parseInt(meal.nooning)>0){
								document.getElementById('exist-noon').classList.remove('mui-hidden');
								document.getElementById('noon-switch').classList.add('mui-active');
								document.getElementById('noon-switch').classList.add('mui-disabled');
							}
							if(parseInt(meal.afternoon)>0){
								document.getElementById('exist-afternoon').classList.remove('mui-hidden');
								document.getElementById('afternoon-switch').classList.add('mui-active');
								document.getElementById('afternoon-switch').classList.add('mui-disabled');
							}
							if(parseInt(meal.afternoon)>0&&parseInt(meal.nooning)>0&&parseInt(meal.morning)>0){
								flag = true;								
								document.getElementById('content').readOnly='true';
							}
							document.getElementById('content').value = meal.content;
						}else{
							window.javaInterface.showWebviewToast(ata.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						window.javaInterface.showWebviewToast("请求失败！请检查网络是否异常!");
					}
				});
			}
			
			//新增
			document.getElementById('addMealPreparation').addEventListener("tap",function(){
				var morning = 0;
				var nooning = 0;
				var afternoon = 0;
				if(document.getElementById('morning-switch').classList.contains('mui-active')){
					morning = 1;		
				}
				if(document.getElementById('noon-switch').classList.contains('mui-active')){
					nooning = 1;		
				}
				if(document.getElementById('afternoon-switch').classList.contains('mui-active')){
					afternoon = 1;		
				}
				if(morning==0&&nooning==0&&afternoon==0){
					window.javaInterface.showWebviewToast("未选择报备时间!");
					return;
				}				
				var content = document.getElementById('content').value;
				if(content==""||content.length<=0){
					window.javaInterface.showWebviewToast("误餐报备事由必填!");
					return;
				}
				if(flag){
					window.javaInterface.showWebviewToast("今日已全部报备!");
					return;
				}
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'addMissMealPrep',
						policenum:policenum,
						morning:morning,
						nooning:nooning,
						afternoon:afternoon,
						content:content
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'GET',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							refreshPage();
							window.javaInterface.showWebviewToast("误餐报备成功!");
						}else{
							window.javaInterface.showWebviewToast(ata.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						window.javaInterface.showWebviewToast("请求失败！请检查网络是否异常!");
					}
				});
			});
			
			refreshPage();
			window.javaInterface.setTitle('误餐报备');  //设置title
		})(mui);
	</script>

</html>