<!--
	作者：836110252@qq.com
	时间：2016-07-21
	业务描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>我的关注</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style type="text/css">
			.mui-content {
				background-color: #fafafa;
				color: #888888;
				font-size: 14px;
			}
			
			.mui-table-view:before,
			.mui-table-view:after {
				background-color: #ffffff;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-scroll-wrapper mui-fullscreen" style="padding-top: 10px;">
			<div class="mui-scroll">
				<ul class="mui-table-view">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="javascript:;" id="wodexiashu">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 我的下属</span>
						</a>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 10px;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="../judgments/index.php" id="wdpj">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 我的评价</span>
						</a>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 10px;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="javascript:;" id="mineExceptionList">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 我的异常</span>
						</a>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 10px;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="../jcj_detail/index.php" id="minejcj">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 接处警</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init({
				swipeBack: false
			});
			(function($) {
				//我的下属		
				document.getElementById('wodexiashu').addEventListener("tap", function() {
					window.javaInterface.openFragmentAttendanceManageActivity();
				});
				document.getElementById('mineExceptionList').addEventListener("tap", function() {
					window.javaInterface.startDatePickHtmlActivity(basePath + '/extapp/app/html5/attendance/mineexception/index.php');
				});
				
				setTitle('我的关注');
			})(mui);
		</script>
	</body>

</html>