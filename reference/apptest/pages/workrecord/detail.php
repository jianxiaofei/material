<!--
模块名称：工作记录详情
作者：836110252@qq.com
时间：2016-07-19
业务逻辑描述：1、根据列表页传过来的id查询此条工作日志的详细信息
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>工作记录详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			html,
			body,
			.mui-content {
				background-color: #FFF;
			}
			
			.mui-input-row label {
				font-size: 1rem;
			}
			
			.mui-input-row .mui-btn {
				padding: 0 !important;
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
			/*自适应文本框高度*/
			
			.chackTextarea-area {
				min-height: 20px;
				max-height: 400px;
				_height: 120px;
				margin-left: auto;
				margin-right: auto;
				padding: 3px;
				outline: 0;
				border: 1px solid #a0b3d6;
				font-size: 12px;
				line-height: 24px;
				padding: 2px;
				word-wrap: break-word;
				overflow-x: hidden;
				overflow-y: auto;
				border-color: rgba(82, 168, 236, 0.8);
				box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6);
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
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-fullscreen mui-scroll-wrapper">
			<div class="mui-scroll" id="detail">
				<div class="mui-row mui-content-padded">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<p>
							记录时间：
						</p>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="logtime">

						</p>
					</div>
				</div>
				<div class="mui-row mui-content-padded">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<p>
							工作日期：
						</p>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="finishtime">

						</p>
					</div>
				</div>
				<div class="mui-row mui-content-padded">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<p>
							工作内容：
						</p>
					</div>
					<div class="mui-col-sm-8 mui-col-xs-7">
						<div class="chackTextarea-area" contenteditable="false" id="textarea">
							<!--							<textarea id="textarea" class="chackTextarea-area" readonly="readonly" >-->

							<!--</textarea>-->
						</div>
					</div>
					<div class="mui-col-sm-1 mui-col-xs-1"></div>
				</div>
				<div id="list_image" class="mui-row mui-content-padded"></div>
			</div>
		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script src="../../js/jquery.min.js"></script>
		<script src="../../js/textareaAutoHeight.js"></script>
		<script>
			mui.init({
				gestureConfig: {
					tap: true, //默认为true
					doubletap: true, //默认为false
					longtap: true, //默认为false
					drag: true, //默认为true
					hold: true, //默认为false，不监听
					release: true //默认为false，不监听
				},
				swipeBack: false
			});
			var token = getToken();
			var id = <?php echo "'". $_GET["id"] . "'" ?>;
			//var id = 1;
			(function($) {
				mui.ajax(basePath + '/osapi/worklog.php', {
					data: {
						action: 'getWorklogDetail',
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
							var result = data.result;
							var html = "";
							var text = eval("(" + result.detail + ")");
							if(result.attachements.length > 0) {
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<p>附件列表：</p></div>';
								html += '<div class="mui-row mui-col-sm-9 mui-col-xs-8">';
								mui.each(result.attachements, function(index, item) {
									html += '<div class="mui-col-sm-4 mui-col-xs-3">';
									html += '<img data-preview-src="" data-preview-group="1" width="150px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
								});
								html += '</div></div>';
							}
							document.getElementById('logtime').textContent = result.logtime;
							document.getElementById('finishtime').textContent = result.finishtime;
							document.getElementById('textarea').textContent = text[0].text;

							document.getElementById('list_image').innerHTML = html;

						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});
				setTitle("工作记录详情");
			})(mui);

			mui.previewImage();
		</script>
	</body>

</html>