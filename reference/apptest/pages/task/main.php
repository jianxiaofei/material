<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>任务管理</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" href="../../css/iconfont.css"/>
		<style>.title {
	margin: 20px 15px 7px;
	color: #6d6d72;
	font-size: 15px;
}

.mui-bar {
	background-color: #196fc6;
}

.mui-content {
	background-color: #fafafa;
	color: #888888;
	font-size: 14px;
}

.mui-navigate-right img,
.mui-navigate-right span {
	float: left;
}

.mui-navigate-right img {
	width: 6%;
}

.mui-bar-tab .mui-tab-item.mui-active {
	color: #929292;
}

.mui-bar-tab .mui-tab-item.tom-active {
	color: #007aff;
}

.mui-navigate-right span {
	margin-left: 5%;
}

.mui-navigate-right:after,
.mui-push-left:after,
.mui-push-right:after {
	top: 46%
}

.mui-title {
	color: #ffffff;
}

.mui-table-view:before,
.mui-table-view:after {
	background-color: #ffffff;
}

a {
	color: #ffffff;
}</style>
	</head>

	<body>
		<div class="mui-content">
			<!--<div class="mui-card">-->
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" id="sendTask" href="javascript:;">
						<span class="mui-icon iconfont datatom-icon-fachuderenwu" style="color:#72e696;"></span>
						<span> 发出的任务</span>
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" id="acceptTask" href="javascript:;">
						<span class="mui-icon iconfont datatom-icon-shoudaoderenwu" style="color:#deec68;"></span>
						<span> 收到的任务</span>
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" id="supervisorTask" href="javascript:;">
						<span class="mui-icon iconfont datatom-icon-renwujiankong" style="color:#6ecefe;"></span>
						<span> 任务监控</span>
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="myCalendarBtn">
						<span class="mui-icon iconfont datatom-icon-wodericheng" style="color:#ffc957;"></span>
						<span> 我的日程</span>
					</a>
				</li>
			</ul>
			<br />
			<ul class="mui-table-view">
				<li class="mui-table-view-cell mui-hidden">
					<a class="mui-navigate-right" href="javascript:;" id="xtgw">
						<span class="mui-icon iconfont datatom-icon-gongwen" style="color:#c8e992;"></span>
						<span> 公文</span>
					</a>
				</li>
				<li class="mui-table-view-cell mui-hidden">
					<a class="mui-navigate-right" href="javascript:;" id="xtjjc">
						<span class="mui-icon iconfont datatom-icon-jiechujing" style="color:#ff7777;"></span>
						<span> 暂定</span>
					</a>
				</li>
				<li class="mui-table-view-cell mui-hidden">
					<a class="mui-navigate-right" id="commandCenter" href="javascript:;">
						<span class="mui-icon iconfont datatom-icon-zhihuizhongxinrenwu" style="color:#ff6677;"></span>
						<span> 接处警</span>
					</a>
				</li>
			</ul>
			<br />
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="newTaskBtn">
						<span class="mui-icon iconfont datatom-icon-xinjianrenwu" style="color:#ffaf78;"></span>
						<span> 新建任务</span>
					</a>
				</li>
			</ul>

			<!--</div>-->
		</div>
		<nav class="mui-bar mui-bar-tab footer_nav" style="background-color: #FFF;">
			<a class="mui-tab-item" id="index" style="color:#929292;">
				<span class="mui-icon iconfont datatom-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a class="mui-tab-item mui-active tom-active" id="task">
				<span class="mui-icon iconfont datatom-icon-woderenwu"></span>
				<span class="mui-tab-label">我的任务</span>
			</a>
			<a class="mui-tab-item" id="addWork" style="color:#929292;">
				<span class="mui-icon iconfont datatom-icon-xinzeng" style="font-size: 2.3rem;top: -2px;width: auto;"></span>
			</a>
			<a class="mui-tab-item" id="contact" style="color:#929292;">
				<span class="mui-icon iconfont datatom-icon-tongxunlu"></span>
				<span class="mui-tab-label">通讯录</span>
			</a>
			<a class="mui-tab-item" id="mine" style="color:#929292;">
				<span class="mui-icon iconfont datatom-icon-mine"></span>
				<span class="mui-tab-label">我的</span>
			</a>
		</nav>
	</body>
	<script src="../../js/mui.min.js"></script>
	<script src="../../js/common.js"></script>
	<script>mui.init();
(function($) {
	var nowDate = getNowFormatDate();
	//发出的任务
	document.getElementById('sendTask').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/task/taskList.php?pageType=send");
	});
	//接收的任务
	document.getElementById('acceptTask').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/task/taskList.php?pageType=accept");
	});
	//任务监控
	document.getElementById('supervisorTask').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/task/taskList.php?pageType=supervisor");
	});
	//我的日程
	document.getElementById('myCalendarBtn').addEventListener("tap", function() {
		window.javaInterface.startTaskActivity();
	});
	//指挥中心任务处理
	document.getElementById('commandCenter').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/commandcenter/list.php");
	});

	//首页
	document.getElementById('index').addEventListener('tap', function() {
		//window.location.reload();
		//window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/index.php")
		window.javaInterface.returnMainHtml();

	});
	//我的任务
	document.getElementById("task").addEventListener('tap', function() {
			window.location.reload();
		})
//		//新增工作日志--暂时界面未定
//	document.getElementById('addWork').addEventListener('tap', function() {
//		window.javaInterface.openAddWorkLogActivity();
//	});
	//通讯录
	document.getElementById('contact').addEventListener('tap', function() {
		window.javaInterface.startNonTitleBarHtmlActivity(basePath + "/extapp/app/html5/contacts/index.php");
	});
	//我的
	document.getElementById('mine').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/mine/index.php", true);
	});
	//新建任务
	document.getElementById('newTaskBtn').addEventListener("tap", function() {
		window.javaInterface.newTaskBtn();
	});
	//公文
	document.getElementById('xtgw').addEventListener("tap", function() {
		window.javaInterface.officialDocument();
	});
	//接警处
	document.getElementById('xtjjc').addEventListener("tap", function() {
		window.javaInterface.receiveDisposalAlarm();
	});
	//新增工作日志
	document.getElementById('addWork').addEventListener('tap', function() {
		window.javaInterface.startDefaultHtmlActivity(basePath + "/extapp/app/html5/workrecord/add.php?date=" + nowDate);
//		window.javaInterface.openAddWorkLogActivity();
	});
	window.javaInterface.setTitle('任务管理'); //设置title
})(mui);</script>

</html>