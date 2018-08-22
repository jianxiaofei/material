<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>问题反馈</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			html,
			body {
				background-color: #efeff4;
				    font-size: 14px;
                    color: #888888;
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
		<div class="mui-content">
			<div class="mui-content-padded">
				<textarea id="content" cols="*" rows="10" placeholder="请输入反馈内容"></textarea>
			</div>
			<div class="mui-button-row" style="margin-top: 20px;">
				<button id="addFeedback" type="button" class="mui-btn mui-btn-primary" style="width: 90%;height: 46px;">提交</button>
			</div>
		</div>
	</body>
	<script src="../../js/mui.min.js "></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init();
		
		var policenum = window.javaInterface.getPolicenum();//"005566";//
		var token = window.javaInterface.getToken();//"6C4BB022-1F6C-FD33-9E92-D8C0AB09013F";//
		var realname = window.javaInterface.getRealname();
		(function($) {
			document.getElementById('addFeedback').addEventListener("tap",function(){
				var content = document.getElementById('content').value;
				if(null==content||""==content||undefined==content){
					window.javaInterface.showWebviewToast("反馈内容必填!");
					return;
				}
				var params = '{"name":"'+realname+'","policenum":"'+policenum+'","msg":"'+content+'"}';
				mui.ajax(basePath+'/apps/feedback/add',{
					data:params,
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
						request.setRequestHeader("Content-Type", "application/json;charset=utf-8");
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						window.location.reload();
						window.javaInterface.showWebviewToast("反馈意见提交成功!");
					},
					error:function(xhr,type,errorThrown){
						window.javaInterface.showWebviewToast("网络异常!");
					}
				});
			});
			
			setTitle('帮助与反馈');  //设置title
		})(mui);
	</script>

</html>