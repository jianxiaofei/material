<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>修改密码</title>
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
			input:-ms-input-placeholder {
			    color: #888;
			    font-size: .8rem;
			}
			
			input::-webkit-input-placeholder {
			    color: #888;
			    font-size: .8rem;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content">
			<form class="mui-input-group" style="margin-top: 20px;">
				<div class="mui-input-row mui-password">
					<label>原密码</label>
					<input id="oldpass" type="password" class="mui-input-password mui-input-clear" placeholder="请输入原密码" data-input-clear="5"><span class="mui-icon mui-icon-clear mui-hidden"></span>
				</div>
				<div class="mui-input-row mui-password">
					<label>新密码</label>
					<input id="newpass" type="password" class="mui-input-password mui-input-clear" placeholder="请输入新密码" data-input-clear="5"><span class="mui-icon mui-icon-clear mui-hidden"></span>
				</div>

				<div class="mui-input-row mui-password">
					<label>确认密码</label>
					<input id="newrepass" type="password" class="mui-input-password mui-input-clear" placeholder="请输入确认密码" data-input-clear="5"><span class="mui-icon mui-icon-clear mui-hidden"></span>
				</div>
			</form>
			<div class="mui-button-row" style="margin-top: 20px;">
				<button id="changePassword" type="button" class="mui-btn mui-btn-primary" style="width: 90%;height: 46px;">提交</button>
			</div>
		</div>
	</body>
	<script src="../../js/mui.min.js"></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init();
		var policenum = window.javaInterface.getPolicenum();//"005566";//
		var token = window.javaInterface.getToken();//"6C4BB022-1F6C-FD33-9E92-D8C0AB09013F";//
		(function($) {
			document.getElementById('changePassword').addEventListener("tap",function(){
				var oldpass = document.getElementById('oldpass').value;
				var newpass = document.getElementById('newpass').value;
				var newrepass = document.getElementById('newrepass').value;
				if(null==oldpass||""==oldpass||undefined==oldpass){
					showWebviewToast("原密码不能为空!");
					return;
				}
				if(null==newpass||""==newpass||undefined==newpass){
					showWebviewToast("新密码不能为空!");
					return;
				}
				if(null==newrepass||""==newrepass||undefined==newrepass){
					showWebviewToast("确认密码不能为空!");
					return;
				}
				if(newpass!=newrepass){
					showWebviewToast("两次输入的新密码不一致!");
					return;
				}
				
				mui.ajax(basePath+'/osapi/user.php',{
					data:{
						"action":"setPwd",
						"policenum":policenum,
						"oldpwd":oldpass,
						"newpwd":newpass
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							mui.back();
							showWebviewToast('密码修改成功!');
							return;
						}else{
							mui.reload();
							showWebviewToast('密码修改失败!');
							return;
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
			});
			
			setTitle('修改密码');  //设置title
		})(mui);
	</script>

</html>