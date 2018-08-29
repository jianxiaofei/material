<!--
作者：836110252@qq.com
时间：2016-05-29
描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>我的</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" href="../../css/iconfont.css" />

		<style>
			html,
			body {
				background-color: #efeff4;
				font-size: 14px;
				color: #888888;
			}
			
			.mui-table-view {
				margin-top: 20px;
			}
			
			.mui-content .mui-table-view:first-child {
				margin-top: 15px;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell mui-media">
							<a class="mui-navigate-right" href="javascript:void(0);">
								<img class="mui-media-object mui-pull-left head-img" id="head-img" src="">
								<div class="mui-media-body" id="main-account">

								</div>
							</a>
						</li>
					</ul>
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell">
							<a href="qrcode.php" class="mui-navigate-right">
								查看二维码
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="changepassword.php" class="mui-navigate-right">
								修改密码
							</a>
						</li>
					</ul>
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell">
							<a href="feedback.php" class="mui-navigate-right">
								帮助与反馈
							</a>
						</li>
						<li class="mui-table-view-cell mui-hidden">
							<a href="javascript:void(0);" class="mui-navigate-right " onclick="window.javaInterface.clearCache();">
								清空缓存
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="javascript:void(0);" class="mui-navigate-right" onclick="window.javaInterface.checkUpdate();">
								检查新版本
							</a>
						</li>
					</ul>
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell">
							<a href="javascript:void(0);" class="mui-navigate-right">
								关于诚信系统 <i class="mui-pull-right update">V2.0.0</i>
							</a>
						</li>
					</ul>
					<ul class="mui-table-view">
						<li class="mui-table-view-cell" style="text-align: center;">
							<a href="javascript:void(0);" onclick="window.javaInterface.loginOut();">
								退出登录
							</a>
						</li>
					</ul>
				</div>
			</div>
			<nav class="mui-bar mui-bar-tab footer_nav" style="background-color: #FFF;">
				<a class="mui-tab-item" id="index" style="color:#929292;">
					<span class="mui-icon iconfont datatom-icon-home"></span>
					<span class="mui-tab-label">首页</span>
				</a>
				<a class="mui-tab-item" id="task" style="color:#929292;">
					<span class="mui-icon iconfont datatom-icon-woderenwu"></span>
					<span class="mui-tab-label">我的任务</span>
				</a>
				<a class="mui-tab-item" id="addWork"  style="color:#929292;">
					<span class="mui-icon iconfont datatom-icon-xinzeng" style="font-size: 2.3rem;top: -2px;width: auto;"></span>
				</a>
				<a class="mui-tab-item " id="contact" style="color:#929292;">
					<span class="mui-icon iconfont datatom-icon-tongxunlu"></span>
					<span class="mui-tab-label">通讯录</span>
				</a>
				<a class="mui-tab-item mui-active tom-active" id="mine"  style="color:#007aff;">
					<span class="mui-icon iconfont datatom-icon-mine"></span>
					<span class="mui-tab-label">我的</span>
				</a>
			</nav>
		</div>
	</body>
	<script src="../../js/mui.min.js "></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init();
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();

		var policenum = getPolicenum();
		var token = getToken();
		var realname = getRealname();

		(function($) {

			document.getElementById("head-img").src = basePath + "/osapi/avantar.php?policenum=" + policenum;
			document.getElementById("main-account").innerHTML = realname + "<p class='mui-ellipsis'>警员编号:" + policenum + "</p>";
			//首页
			document.getElementById('index').addEventListener('tap', function() {
				//window.location.reload();
				//		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/index.php")
				window.javaInterface.returnMainHtml()
			});
			//我的任务
			document.getElementById("task").addEventListener('tap', function() {
					window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/task/main.php", true);
				})
				var nowDate = getNowFormatDate();
				//新增工作日志--暂时界面未定
			document.getElementById('addWork').addEventListener('tap', function() {
				window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/workrecord/add.php?date=" + nowDate);
//				window.javaInterface.openAddWorkLogActivity();
			});
			//通讯录
			document.getElementById('contact').addEventListener('tap', function() {
				window.javaInterface.startNonTitleBarHtmlActivity(basePath + "/extapp/app/html5/contacts/index.php");
				//window.location.reload();
			});
			//我的
			document.getElementById('mine').addEventListener('tap', function() {
				window.location.reload();

				//window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/mine/index.php");
			});
			/*mui.ajax(basePath+'/osapi/friend.php',{
			data:{
			action:'listmygroup',
			userpnum:policenum
			},
			beforeSend: function(request) {
			request.setRequestHeader("U-Auth-Token", token);
			},
			dataType:'json',//服务器返回json格式数据
			type:'POST',//HTTP请求类型
			timeout:10000,//超时时间设置为10秒；
			success:function(data){
			if(data.code=="200"){

			}else{
			mui.alert(data.msg);
			}
			},
			error:function(xhr,type,errorThrown){
			mui.alert('请求失败！请检查网络是否异常!', '警告信息');
			}
			});*/
			window.javaInterface.setTitle('个人中心'); //设置title
		})(mui);
	</script>

</html>