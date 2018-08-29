<!--
作者：836110252@qq.com
时间：2016-05-29
描述：我的审批：考勤异常审批详情
-->
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>请假审批详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->
		<link rel="stylesheet" href="../../../css/mui.min.css">
		<style>
			html,
			body,
			.mui-content {
				color: #888;
				background-color: #FFF;
			}
			
			.datatom-text-left {
				text-align: left;
			}
			
			.datatom-footer {
				position: fixed;
				z-index: 10;
				right: 0;
				left: 0;
				border-bottom: 0;
				background-color: #fff;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				-webkit-backface-visibility: hidden;
				backface-visibility: hidden;
				bottom: 0;
				display: table;
				width: 100%;
				height: 44px;
				padding: 0;
				table-layout: fixed;
				border-top: 0;
				-webkit-touch-callout: none;
			}
			
			.datatom-item {
				text-decoration: none;
				display: table-cell;
				overflow: hidden;
				width: 1%;
				height: 44px;
				text-align: center;
				vertical-align: middle;
				white-space: nowrap;
				text-overflow: ellipsis;
				color: #007aff;
			}
			
			.mui-col-sm-2 img,
			.mui-col-sm-7 img {
				width: 50px;
				height: 50px;
				border-radius: 50%;
			}
			
			.datatom-border-bottom {
				border-bottom: 1px solid #888;
			}
			
			.datatom-img-tips {
				position: absolute;
				right: 5%;
			}
			
			.datatom-line {
				border: 1px solid #888;
				height: 1px;
				margin-left: 10px;
				margin-right: 10px;
			}
			
			.mui-row label {
				font-size: .9rem;
			}
		</style>
	</head>

	<body>
		<div class="mui-content mui-scroll-wrapper mui-fullscreen">
			<div class="mui-scroll" id="content">
				<div class="mui-loading">
					<div class="mui-spinner"></div>
				</div>
			</div>
			<div id="footer" class="datatom-footer ">
			
				<a id="pass" class="datatom-item" href="javascript:;">
					<label class="datatom-label">同意</label>
				</a>
				<a id="nopass" class="datatom-item" href="javascript:;">
					<label class="datatom-label">否决</label>
				</a>
			</div>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script>
			function hasClass(obj, cls) {
				return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
			}

			function removeClass(obj, cls) {
				if(hasClass(obj, cls)) {
					var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
					obj.className = obj.className.replace(reg, ' ');
				}
			}
			mui.init({
				swipeBack: false
			});

			//初始化单页的区域滚动
			mui('.mui-scroll-wrapper').scroll();

			(function($) {
					var id = <?php echo "'". $_GET["id"] . "'" ?>;
					var policenum_data = <?php echo "'". $_GET["policenum"] . "'" ?>;
					var realname = <?php echo "'". $_GET["realname"] . "'" ?>;
					var starttime = <?php echo "'". $_GET["starttime"] . "'" ?>;
					var endtime = <?php echo "'". $_GET["endtime"] . "'" ?>;
					var leavetypestr = <?php echo "'". $_GET["leavetypestr"] . "'" ?>;
					var day = <?php echo "'". $_GET["day"] . "'" ?>;
					var reason=<?php echo "'". $_GET["reason"] . "'" ?>;
					var policenum = getPolicenum();
					var blamerealname = getRealname();
					

					var content = document.getElementById('content');
					var html = '';
					html += '<div class="mui-content-padded"><div class="mui-row">';
					html += '<div class="mui-text-center mui-col-sm-2 mui-col-xs-3">';
					html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + policenum_data + '"/></div>';
					html += '<div class="mui-col-sm-10 mui-col-xs-9">';
					html += '<p>' + realname + ' (' + policenum_data + ')</p></div></div></div>';
					html += '<div class="mui-content-padded">';
					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-12 mui-col-xs-12">';
					html += '<div class="mui-content-padded">';
					html += '<img class="datatom-img-tips" src="../../../img/waitapply.png"/>';

					
					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-3 mui-col-xs-4">';
					html += '<label>开始时间：</label>';
					html += '</div><div class="mui-col-sm-9 mui-col-xs-8">';
					html += '<p class="datatom-text-left">' + starttime + '</p></div></div>';

					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-3 mui-col-xs-4">';
					html += '<label>结束时间：</label>';
					html += '</div><div class="mui-col-sm-9 mui-col-xs-8">';
					html += '<p class="datatom-text-left">' + endtime + '</p></div></div>';
					
					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-3 mui-col-xs-4">';
					html += '<label>请假时常：</label>';
					html += '</div><div class="mui-col-sm-9 mui-col-xs-8">';
					html += '<p class="datatom-text-left">' + day + '天</p></div></div>';
					
					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-3 mui-col-xs-4">';
					html += '<label>请假类型：</label></div>';
					html += '<div class="mui-col-sm-9 mui-col-xs-8">';
					html += '<p class="datatom-text-left">' +leavetypestr+ '</p></div></div>';
					
					html += '<div class="mui-row mui-text-center">';
					html += '<div class="mui-col-sm-3 mui-col-xs-4">';
					html += '<label>请假原因：</label></div>';
					html += '<div class="mui-col-sm-9 mui-col-xs-8">';
					html += '<p class="datatom-text-left">' +reason+ '</p></div></div></div>';
					html += '<div class="datatom-line"></div>';

					
					content.innerHTML = html;
					//否决
					document.getElementById("nopass").addEventListener("tap", function() {
						document.location.href = "finishNeedApply.php?id=" + id+"&pass=" + 1 ;
					});
					//同意
					document.getElementById("pass").addEventListener("tap", function() {
						document.location.href = "finishNeedApply.php?id=" + id+"&pass=" + 0 ;
					});

	

			setTitle('请假审批详情'); //设置title

			})(mui);
		</script>
	</body>

</html>