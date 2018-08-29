<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：日常评价
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>日常评价</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			html,
			body {
				background-color: #FFF;
			}
			
			.mui-content .mui-table-view:first-child {
			    margin-top: 15px;
			}
			.mui-col{
			    margin-right: -4px;
			    display: inline-block;
			}
			.icon-xingxing{
				color: red;
			}
			.icons{
				padding: 5px 15px;
			    float: right;
			    width: 65%;
			    margin-bottom: 0;
			    padding-left: 0;
			    border: 0;
			}
			h5{
				background-color: #efeff4;
			}
			.mui-content-padded {
			    margin: 0; 
			}
			.mui-col-xs-12 span{
				text-align: center;
			}
			.icons i{
				margin-left: 5px;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<header class="mui-bar mui-bar-nav" style="background-color: #003b79;">
			<a href="javascript:;" onclick="window.javaInterface.goAndroidBack();" class="mui-icon mui-icon-left-nav mui-pull-left" style="color: #fff;"></a>
			<h1 class="mui-title" style="color: #fff;font-weight: bold;">日常评价</h1>
		</header>
		<div class="mui-content mui-scroll-wrapper mui-fullscreen">
			<div class="mui-scroll">
				<div class="mui-input-row" style="margin: 0;">
					<textarea id="textarea" rows="5" placeholder="评价字数必须大于5个汉字"></textarea>
				</div>
				<div class="mui-input-row">
					<div class="mui-input-row" style="color: #888;">
						<label style="text-align: right;">星级：</label>
						<div class="icons">
							<i data-index="1" class="mui-icon mui-icon-star-filled"></i>
							<i data-index="2" class="mui-icon mui-icon-star-filled"></i>
							<i data-index="3" class="mui-icon mui-icon-star-filled"></i>
							<i data-index="4" class="mui-icon mui-icon-star-filled"></i>
							<i data-index="5" class="mui-icon mui-icon-star-filled"></i>
						</div>
					</div>
				</div>
				<div class="mui-button-row" style="margin-bottom: 10px;">
					<button id="addEvaluate" type="button" class="mui-btn" style="width: 90%;height: 46px;background-color: #003b79;color: #fff;" onclick="return false;">提交</button>
				</div>
			</div>
		</div>
	</body>
	<script src="../../js/mui.min.js "></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script src="../../js/utils.js"></script>
	<script>
		var policenum;
		var realname;
		var token;
		var usernum;//被评价人policenum
		var jobposition;
		mui.init();
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
		//获取传参
		mui.plusReady(function() {
				policenum = plus.storage.getItem("policenum");
				token = plus.storage.getItem("token");
				realname = plus.storage.getItem("realname");
				jobposition = plus.storage.getItem("jobposition");
				var self = plus.webview.currentWebview();
				usernum = self.usernum;
			});
		var score = 0;
		(function($) {
			
			mui('.icons').on('click','i',function(){
			 	var index = parseInt(this.getAttribute("data-index"));//获取当前元素的索引值
			 	var parent = this.parentNode;//获取当前元素的父节点 
                var children = parent.children;//获取父节点下所有子元素
                if(this.classList.contains("icon-xingxing")){//判断当前节点列表中是否含有.mui-icon-star元素
                    for (var i = index; i < 5; i++) {                        	
                        children[i].classList.remove('icon-xingxing');
                        children[i].classList.remove('mui-icon-starhalf');  
                    }                                          
                	if(this.classList.contains('mui-icon-starhalf')){
                		this.classList.remove('mui-icon-starhalf');
                		score = 2*index;
                	}else{
                		this.classList.remove('icon-xingxing');
                		score = 2*(index-1);
                	}
                }else{//重置已经亮星的元素 
                	score = 2*(index-1)+1;
                	for(var i=0;i<index;i++){//亮星
                		if(index-1==i){
                			children[i].classList.remove('icon-xingxing');
                			children[i].classList.remove('mui-icon-starhalf');
                       		children[i].classList.add('mui-icon-starhalf');
                       		children[i].classList.add('icon-xingxing');
                		}else{
                			children[i].classList.remove('mui-icon-starhalf');
                			children[i].classList.remove('icon-xingxing');
                       		children[i].classList.add('icon-xingxing');
                		}
                   	} 
                }
			 });
			
			document.getElementById('addEvaluate').addEventListener('tap', function() {
			 	var content = document.getElementById('textarea').value;
			 	if(content.trim().length<5){
			 		window.javaInterface.showWebviewToast('评价内容太少了!');
			 		return;
			 	}
				mui.ajax(basePath+'/osapi/evaluation.php',{
					data:{
						action:'addCommonEvaluation',
						policenum:policenum,
						realname:realname,
						jobposition:jobposition,
						usernum:usernum,
						content:content,
						score:score
					},
					beforeSend: function(request) {
	                    request.setRequestHeader("U-Auth-Token", token);
	                },
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if(data.code=="200"){	
							window.location.reload();
							mui.toast("评价成功!");
						}else{
							mui.toast("评价成功!");
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						mui.toast('网络异常');
					}
				});			 	
			 });
			setTitle("日常评价");
		})(mui);
	</script>

</html>