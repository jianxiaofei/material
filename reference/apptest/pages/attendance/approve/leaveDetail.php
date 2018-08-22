
<!--
作者：836110252@qq.com
时间：2016-05-29
描述：我的审批：请假审批详情
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
			
			.mui-preview-image.mui-fullscreen {
				position: fixed;
				z-index: 20;
				background-color: #000;
			}
			
			.mui-preview-header,
			.mui-preview-footer {
				position: absolute;
				width: 100%;
				left: 0;
				z-index: 10;
			}
			
			.mui-preview-header {
				height: 44px;
				top: 0;
			}
			
			.mui-preview-footer {
				height: 50px;
				bottom: 0px;
			}
			
			.mui-preview-header .mui-preview-indicator {
				display: block;
				line-height: 25px;
				color: #fff;
				text-align: center;
				margin: 15px auto 4;
				width: 70px;
				background-color: rgba(0, 0, 0, 0.4);
				border-radius: 12px;
				font-size: 16px;
			}
			
			.mui-preview-image {
				display: none;
				-webkit-animation-duration: 0.5s;
				animation-duration: 0.5s;
				-webkit-animation-fill-mode: both;
				animation-fill-mode: both;
			}
			
			.mui-preview-image.mui-preview-in {
				-webkit-animation-name: fadeIn;
				animation-name: fadeIn;
			}
			
			.mui-preview-image.mui-preview-out {
				background: none;
				-webkit-animation-name: fadeOut;
				animation-name: fadeOut;
			}
			
			.mui-preview-image.mui-preview-out .mui-preview-header,
			.mui-preview-image.mui-preview-out .mui-preview-footer {
				display: none;
			}
			
			.mui-zoom-scroller {
				position: absolute;
				display: -webkit-box;
				display: -webkit-flex;
				display: flex;
				-webkit-box-align: center;
				-webkit-align-items: center;
				align-items: center;
				-webkit-box-pack: center;
				-webkit-justify-content: center;
				justify-content: center;
				left: 0;
				right: 0;
				bottom: 0;
				top: 0;
				width: 100%;
				height: 100%;
				margin: 0;
				-webkit-backface-visibility: hidden;
			}
			
			.mui-zoom {
				-webkit-transform-style: preserve-3d;
				transform-style: preserve-3d;
			}
			
			.mui-slider .mui-slider-group .mui-slider-item img {
				width: auto;
				height: auto;
				max-width: 100%;
				max-height: 100%;
			}
			
			.mui-android-4-1 .mui-slider .mui-slider-group .mui-slider-item img {
				width: 100%;
			}
			
			.mui-android-4-1 .mui-slider.mui-preview-image .mui-slider-group .mui-slider-item {
				display: inline-table;
			}
			
			.mui-android-4-1 .mui-slider.mui-preview-image .mui-zoom-scroller img {
				display: table-cell;
				vertical-align: middle;
			}
			
			.mui-preview-loading {
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
			}
			
			.mui-preview-loading.mui-active {
				display: block;
			}
			
			.mui-preview-loading .mui-spinner-white {
				position: absolute;
				top: 50%;
				left: 50%;
				margin-left: -25px;
				margin-top: -25px;
				height: 50px;
				width: 50px;
			}
			
			.mui-preview-image img.mui-transitioning {
				-webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
				transition: transform 0.5s ease, opacity 0.5s ease;
			}
			
			@-webkit-keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			
			@keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			
			@-webkit-keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}
			
			@keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}
			
			p img {
				max-width: 100%;
				height: auto;
			}
			
			td {
				font-size: .8rem;
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
			<div id="footer" class="datatom-footer mui-hidden">
				<a id="chexiao" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">撤销</label>
				</a>
				<a id="pass" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">同意</label>
				</a>
				<a id="nopass" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">否决</label>
				</a>
			</div>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/mui.zoom.js"></script>
		<script src="../../../js/mui.previewimage.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init({
				swipeBack: false
			});

			//初始化单页的区域滚动
			mui('.mui-scroll-wrapper').scroll();

			(function($) {
				var id = <?php echo "'". $_GET["id"] . "'" ?>;
				var diff = <?php echo "'". $_GET["diff"] . "'" ?>;

				var reason = "";
				var policenum=getPolicenum();
				var date = <?php echo "'". $_GET["date"] . "'" ?>;
				var token = getToken();
				var auditlog;

				mui.ajax(basePath + '/osapi/leave.php', {
					data: {
						action: 'getMyApplyLeaveDetails',
						id: id
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
							var item = data.result;
							reason = item.reason;
							auditlog = item.auditlog;
							var temp_audio = JSON.parse(auditlog);
							var boolean_audio = true;
							mui.each(temp_audio, function(index, item) {
								if(item.pass == 0 && item.policenum == policenum) {
									boolean_audio = false;
								}
							});

							if("1" == item.status && boolean_audio && diff <= 3) {
								document.getElementById("footer").classList.remove("mui-hidden");
								document.getElementById('pass').classList.remove("mui-hidden");
								document.getElementById('nopass').classList.remove("mui-hidden");
							}
							var content = document.getElementById('content');
							var html = "";

							html += '<div class="mui-content-padded">';
							html += '<div class="mui-row">';
							html += '<div class="mui-text-center mui-col-sm-2 mui-col-xs-3">';
							html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
							html += '</div>';
							html += '<div class="mui-col-sm-10 mui-col-xs-9">';
							html += '<p>' + item.realname + '</p>';
							html += '<p style="margin-bottom: 0;">' + item.departmentname + '</p>';
							html += '</div></div></div>';
							html += '<ul class="mui-table-view"><li class="mui-table-view-cell mui-collapse">';
							html += '<a class="mui-navigate-right" href="#">查看请假记录</a>';
							html += '<div class="mui-collapse-content">';
							html += '<table style="width:100%;text-align:center;"><tr><td rowspan="2" style="width:40%;">请假类别</td><td colspan="2" style="width:30%;">上年度</td><td colspan="2" style="width:30%;">本年度</td></tr>';
							html += '<tr><td>次数</td><td>天数</td><td>次数</td><td>天数</td></tr>';
							var stats = item.stats;
							mui.each(stats, function(index, itemStats) {
								html += '<tr><td><span class="mui-badge mui-badge-success">' + itemStats.type + '</span></td><td>' + itemStats.lasttimes + '</td><td>' + itemStats.lastdays + '</td><td>' + itemStats.thistimes + '</td><td>' + itemStats.thisdays + '</td></tr>';
							});
							html += '</table>';
							html += '</div></li></ul>';
							//html += '<div class="datatom-line"></div>';
							html += '<div class="mui-content-padded">';
							if(item.status == "2") {
								html += '<img class="datatom-img-tips" src="../../../img/passapply.png"/>';
							} else if(item.status == "3" || item.status == "5") {
								html += '<img class="datatom-img-tips" src="../../../img/nopassapply.png"/>';
							} else if(item.status == "4") {
								html += '<img class="datatom-img-tips" src="../../../img/cancelapply.png"/>';
							} else {
								html += '<img class="datatom-img-tips" src="../../../img/waitapply.png"/>';
							}
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>申请时间：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.creattime + '</p>';
							html += '</div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>开始时间：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.starttime + '</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>截止时间：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.endtime + '</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>请假时长：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.day + '</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>请假类型：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">';
							html += '<span class="mui-badge mui-badge-purple">' + item.leavetypestr + '</span></p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>请假地域：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">';
							var area = item.place == 1 ? '离开本市' : '本市';
							html += '<span class="mui-badge mui-badge-warning">' + area + '</span>';
							html += '</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>请假事由：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.reason + '</p></div></div>';
							var attachment = JSON.parse(item.attachment);
							if(attachment.length > 0) {
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<label>附件列表：</label></div>';
								html += '<div class="mui-col-sm-9 mui-col-xs-8 mui-row">';
								mui.each(attachment, function(indexattachment, itemattachment) {
									html += '<div class="mui-col-sm-3 mui-col-xs-4">';
									html += '<img data-preview-src="" data-preview-group="1" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + itemattachment.id + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>';
								});
								html += '</div>';
								html += '</div>';
							}
							html += '</div>';
							html += '<div class="datatom-line"></div>';
							if(null != item.auditlog) {
								var audit = JSON.parse(item.auditlog);
								var auditorlist = JSON.parse(item.auditorlist);
								if(audit.length > 0) {
									html += '<div class="mui-content-padded">';
									mui.each(audit, function(index, item) {
										html += '<div class="mui-row mui-text-center">';
										html += '<div class="mui-col-sm-3 mui-col-xs-4">';
										html += '<label>审批人：</label></div>';
										html += '<div class="mui-col-sm-9 mui-col-xs-8">';
										var name = "";
										mui.each(auditorlist, function(index1, item1) {
											if(item1.policenum == item.policenum) {
												name = item1.realname;
											}
										});
										html += '<p class="datatom-text-left">' + name + '</p></div>';
										html += '<div class="mui-row mui-text-center">';
										html += '<div class="mui-col-sm-3 mui-col-xs-4">';
										html += '<label>审批内容：</label></div>';
										html += '<div class="mui-col-sm-9 mui-col-xs-8">';
										if(item.pass == "0") {
											//通过
											if(null == item.comment || "" == item.comment) {
												html += '<p class="datatom-text-left">审批完成（通过）</p>';
											} else {
												html += '<p class="datatom-text-left">审批完成（通过：' + item.comment + '）</p>';
											}
										} else {
											if(null == item.comment || "" == item.comment) {
												html += '<p class="datatom-text-left">审批完成（未通过）</p>';
											} else {
												html += '<p class="datatom-text-left">审批完成（未通过：' + item.comment + '）</p>';
											}
										}
										html += '</div></div>';
									});
									html += '</div>';
								}
							}
							html += '</div></div>';
							content.innerHTML = html;

						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});
				//通过
				document.getElementById("pass").addEventListener("tap", function() {
					document.location.href = "finishLeave.php?policenum=" + policenum+"&pass=" + 0 + '&id=' + id;

				});
				//不通过
				document.getElementById("nopass").addEventListener("tap", function() {
					document.location.href = "finishLeave.php?policenum=" + policenum+"&pass=" + 1 + '&id=' + id;
				});

				setTitle('请假审批详情'); //设置title

			})(mui);
			mui.previewImage();
		</script>
	</body>

</html>
