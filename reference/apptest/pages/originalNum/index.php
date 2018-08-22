<!--
作者：836110252@qq.com
时间：2016-07-21
业务描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>原号系统</title>
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
				<ul class="mui-table-view mui-hidden" id="applyNum">
					<li class="mui-table-view-cell ">
						<a class="mui-navigate-right " href="javascript:;">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 申请原号</span>
						</a>
					</li>
				</ul>
				<ul class="mui-table-view mui-hidden" style="margin-top: 10px;" id="wdpj">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="list_audit.php">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 核发原号</span>
						</a>
					</li>
				</ul>
				<ul class="mui-table-view mui-hidden" style="margin-top: 10px;" id="yhlist">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="javascript:;">
							<span class="mui-icon iconfont icon-xinjianrenwu" style="color:#ffaf78;"></span>
							<span> 原号展示</span>
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
			var type = <?php echo "'". $_GET["type"] . "'" ?>;
			if(type == '2') {
				document.getElementById('applyNum').classList.remove('mui-hidden');
			} else if(type == '3') {
				document.getElementById('wdpj').classList.remove('mui-hidden');
				document.getElementById('yhlist').classList.remove('mui-hidden');
			} else if(type == '4'){
				document.getElementById('yhlist').classList.remove('mui-hidden');
			}
			(function($) {
				//申请原号
				document.getElementById('applyNum').addEventListener("tap", function() {
					window.location.href = "apply/applyNum.php"
				});
				document.getElementById('yhlist').addEventListener("tap", function() {
					window.location.href = "list.php"
				});
				setTitle('原号系统');
			})(mui);
		</script>
	</body>
</html>