<!--
	作者：Alex
	时间：2017-03-25
	业务描述：1、根据记录id查询设施上报详细信息,附带参数token
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css">
		<!--App自定义的css-->
		<link rel="stylesheet" href="../../css/style.css" />
		<style>
			p {
				word-wrap: break-word;
				word-break: normal;
				white-space: pre-wrap;
			}
			/*img{
				width: 100%;
			}*/
			
			.mui-media-object {
				border-radius: 50%;
			}
			
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
				-webkit-backface-visibility: ;
			}
			.showtext{
				-webkit-user-select:all;
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
		</style>
	</head>

	<body>
		<div class="mui-content" id="content">

		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			var id;
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
			(function($) {
				var token = getToken();
				id = <?php echo "'". $_GET["id"] . "'" ?>;

				mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
					data: {
						action: 'getTaskOfAppFormId',
						id: "1820",
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
							var info = data.result[0];
							var content = document.getElementById('content');
							var html = "";
							//<img src="../../img/处理中.png" style="position: absolute;display: block;width: 30%;z-index: 99999;right: 10px;transform: rotate(-47deg);top: 40px;"/>
							html += '<ul class="mui-table-view" style="margin-top: 0;">';
							html += '<li class="mui-table-view-cell mui-media">';
							html += '<a href="javascript:;">';
							html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + info.recordpeoplenum + '" class="mui-pull-left mui-media-object"/>';
							html += '<div class="mui-media-body">' + info.recordpeople;
							html += '</div></a></li></ul>';
							html += '<div class="mui-content-padded"><p>';
										html += '<label>任务等级:</label>';
							var levelStr = "普通";
							var levelColor = "blue";
							if(info.level == 1) {
								levelStr = "普通";
								levelColor = "blue";
							} else if(info.level == 2) {
								levelStr = "紧急";
								levelColor = "yellow";
							} else if(info.level == 3) {
								levelStr = "加急";
								levelColor = "red";
							}
							html += '<span class="mui-badge" style="background-color:' + levelColor + ';color:#fff;">' + levelStr + '</span>';
							html += '</p><p><label>任务类型:</label><span class="mui-badge mui-badge-blue">' + info.value + '</span>';
							html += '<p><label>事件发生地:</label><span>' + info.location + '</span></p>';
							html += '<p><label>事件内容:</label><span>' + info.faultcontent + '</span></p>';
							html += '<p><label>任务内容要求:</label><span>' + info.remarks + '</span></p>';
							html += '<p><label>创建时间:</label><span>' + info.createtime + '</span></p>';
							html += '<p><label>任务相关人:</label><span>' + info.sendpeople + '</span></p>';
							if(undefined != info.enclosureid && null != info.enclosureid && "" != info.enclosureid) {
								var enclosureidArr = info.enclosureid.split(",");
								html += '<p><label>相关附件:</label>';
								mui.each(enclosureidArr, function(index, item) {
									html += '<img width="50px" src="http://58.42.244.76:8088/api/media/image/thumbnail/preview?debug=true&fileid=' + item + '"/>';
								});
								html += '</p>';
							}
							html += '</div>';
			
							var step = data.result.action;
							var length = step.length;
							if(length > 0) {
								html += '<ul class="datatom-timeline">';
							}
							for(var i = 0; i < length; i++) {
								var status = step[i].status;
								var title = "";
								if(status == 0) {
									title = step[i].action_name + "发出任务";
								} else if(status == 2) {
									title = step[i].action_name + "接收任务";
								} else if(status == 3) {
									title = step[i].action_name + "回复任务";
								} else if(status == 4) {
									title = step[i].action_name + "提醒任务";
								} else if(status == 5) {
									title = step[i].action_name + "转发任务给" + step[i].accept_name;
								} else if(status == 6) {
									title = step[i].action_name + "完成任务";
								} else if(status == 7) {
									title = step[i].action_name + "评价任务";
								} else if(status == 8) {
									title = step[i].action_name + "进行了签到";
								}
								var actioncontent = step[i].content == null ? "" : step[i].content;
								html += '<li><span class="mui-icon iconfont datatom-icon-chuliwancheng" style="color: #440044;"></span>';
								html += '<div class="mui-card datatom-timeline-item">';
								html += '<div class="datatom-triangle"></div>';
								html += '<ul class="mui-table-view">';
								html += '<li class="mui-table-view-cell mui-media">';
								html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + step[i].action_policenum + '" class="mui-media-object mui-pull-left"/>';
								html += '<div class="mui-media-body">' + title;
								html += '<p class="mui-pull-right">' + step[i].time + '</p>';
								html += '<p class="mui-ellipsis" style="color: #440044;">' + actioncontent + '</p>';
								if(step[i].enclosureid != undefined && step[i].enclosureid != null && "" != step[i].enclosureid) {
									var enclosureidArr = step[i].enclosureid.split(",");
									mui.each(enclosureidArr, function(index, item) {
										//								html += '<p class="mui-ellipsis datatom-img"><img src="http://58.42.244.76:8088/api/media/image/thumbnail/preview?debug=true&fileid='+item+'"/></p>';
										html += '<img data-preview-src="" data-preview-group="1" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/>'
									});
								}
								html += '</div></li></ul></div></li>';
							}
							if(length > 0) {
								html += '</ul>';
							}
			
							var monitornum = data.result.base.monitornum;
							if(null != monitornum && "" != monitornum && undefined != monitornum) {
								html += '<div class="mui-card">';
								html += '<div class="mui-card-header">监督人<span style="font-size: .5rem;">(任务处理消息将抄送给以下人员)</span></div>';
								html += '<div class="mui-card-content">';
								html += '<ul class="mui-table-view mui-grid-view mui-grid-9">';
								var monitornumArr = monitornum.split(",");
								var monitorName = info.monitor.split(",");
								for(var j = 0; j < monitornumArr.length; j++) {
									html += '<li style="padding-top: 0;padding-bottom: 0;" class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">';
									html += '<a href="#">';
									html += '<img style="width:50%;" src="' + basePath + '/osapi/avantar.php?policenum=' + monitornumArr[j] + '" class="mui-media-object"/>';
									html += '<div class="mui-media-body">' + monitorName[j] + '</div>';
									html += '</a></li>';
								}
								html += '</ul></div></div>';
							}
			
							content.innerHTML = html;
						} else {
							mui.toast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						mui.toast("网络异常!");
					}
				});
				setTitle("上报详情");
			})(mui);
			mui.previewImage();
		</script>

	</body>

</html>