<!--
	作者：836110252@qq.com
	时间：2016-05-29
	模块名称：提交上级
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>提交上级</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../../css/mui.min.css">
	<style>
		html,body,.mui-content{
			background-color: #fff;
		}
		.mui-row label{
			padding-right: 20px;
			color: #8f8f94;
			font-size: 14px;
		}
		.mui-row p{
			margin: 0;
		}
		.mui-row select{
			margin: 0;
			padding: 0;
			border: 1px solid rgba(0,0,0,.2) !important;
    		border-radius: 3px;
		}
		.mui-col-sm-3{
			text-align: right;
		}
	</style>
</head>
<body class="mui-fullscreen">
	<div id="pullrefresh" class="mui-content mui-scroll-wrapper">
		<div class="mui-scroll" id="listAtt">
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>异常内容：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="title"></p>
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>异常日期：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="alias"></p>
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>提交者：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="name"></p>
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>申请类型：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<select id="reason" name="type">
							<option value="事假">事假</option>
							<option value="学习">学习</option>
							<option value="任务">任务</option>
							<option value="开会">开会</option>
							<option value="调休">调休</option>
							<option value="病假">病假</option>
							<option value="婚假">婚假</option>
							<option value="年假">年假</option>
							<option value="其他">其他</option>
						</select>
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>异常原因：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<textarea id="content" rows="8" placeholder="请输入异常原因"></textarea>
					</div>
				</div>
			</div>
			<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
				<button id="submitApply" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
			</div>
		</div>
	</div>
<script src="../../../js/mui.min.js" charset="UTF-8"></script>
<script src="../../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init();
	mui('.mui-scroll-wrapper').scroll();
	var title = <?php echo "'". $_GET["title"] . "'" ?>;
	var alias = <?php echo "'". $_GET["alias"] . "'" ?>;
	var realname = <?php echo "'". $_GET["realname"] . "'" ?>;
	var date = <?php echo "'". $_GET["date"] . "'" ?>;
	var policenum = getPolicenum();
	var token = getToken();

	(function($) {		
		
		document.getElementById('title').innerHTML = title;
		document.getElementById('alias').innerHTML = alias;
		document.getElementById('name').innerHTML = realname;
		
		document.getElementById('submitApply').addEventListener("tap",function(){
			var reason = document.getElementById('reason').value;
			var content = document.getElementById('content').value;
			if(null==content||""==content||undefined==content){
				showWebviewToast("请输入异常申请内容");
				return;
			}
			var applyContent = reason+":"+content;
			
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:"applyErrorAudit",
					policenum:policenum,
					date:date,
					applyContent:applyContent
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if("200"==data.code){
						window.javaInterface.startDatePickHtmlActivity(basePath+'/extapp/app/html5/attendance/mineexception/index.php');
						showWebviewToast("异常成功提交上级!");
					}else{
						showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		});
		
		setTitle("提交上级");
	})(mui);
	
</script>
</body>
</html>