<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>任务详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/feedback.css" />

		<style>
			html,
			body,
			.mui-content {
				background-color: #F6F5F1;
			}
			
			.datatom-task-name {
				font-weight: bold;
				color: #007aff;
				font-size: 14px;
			}
			
			.datatom-info {
				margin-bottom: 0;
			}
			
			.datatom-task-title {
				padding-left: 15px;
			}
			
			.datatom-task-title span {
				padding-left: 2%;
				border-left: 3px solid blue;
			}
			
			.datatom-task-detail {
				text-indent: 20px;
				margin-bottom: 0;
				padding: 1rem;
			}
			
			.mui-table-view:before,
			.mui-table-view:after {
				background-color: #fff;
			}
			/**
* 底部处理按钮样式
* */
			
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
				border-bottom: 1px solid #888;
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
			
			.datatom-tline-box {
				background-color: #F6F5F1;
			}
			
			.datatom-tline {
				padding: 0 29px 15px;
				border-top: 1px solid #DADAD8;
			}
			
			.datatom-time-node {
				position: relative;
				overflow: hidden;
			}
			
			.datatom-time-node:before {
				position: absolute;
				top: 0;
				bottom: 0;
				left: 12px;
				width: 1px;
				display: block;
				background: blue;
				content: '';
			}
			
			.datatom-time-node:last-child:before {
				bottom: auto;
				height: 30px;
				content: '';
			}
			
			.datatom-node-status {
				display: inline-block;
				border-radius: 50%;
				background: #F6F5F1;
				position: absolute;
				top: 30px;
				left: 0;
				text-align: center;
				background-color: #007aff;
			}
			
			.mui-icon {
				color: #fff;
			}
			
			.datatom-node-box {
				margin: 18px 0 0 22px;
				position: relative;
			}
			
			.datatom-node-box .arrow {
				width: 8px;
				height: 16px;
				position: absolute;
				overflow: hidden;
				top: 8px;
				left: 1px;
				z-index: 1;
			}
			
			.datatom-node-box-inner {
				position: relative;
				padding: 14px 14px 14px 64px;
				margin-left: 8px;
				border: 1px solid #dcdcdc;
				border-radius: 5px;
				background: #fff;
				overflow: hidden;
			}
			
			.datatom-node-box-inner img {
				width: 40px;
				height: 40px;
				overflow: hidden;
				cursor: pointer;
				border-radius: 50%;
				position: absolute;
				top: 14px;
				left: 14px;
				color: #fff;
				line-height: 40px;
				text-align: center;
				font-size: 12px;
			}
			
			.datatom-oprerate-title {
				color: #222;
				font-size: 12px;
			}
			
			.datatom-opreratetime {
				color: #858e99;
				font-size: 12px;
				-webkit-transform: scale(.8);
				transform: scale(.8);
			}
			
			.datatom-oprerate-content {
				color: #75C813;
				font-size: 14px;
				margin-top: 7px;
				display: inline-block;
				min-height: 16px;
				line-height: 16px;
				overflow: hidden;
			}
			
			.datatom-node-box-inner p {
				margin-bottom: 0;
			}
			
			.mui-row {
				background-color: #fff;
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
			
			i {
				background-color: #49AFCD;
				border-radius: 25px;
			}
		</style>
	</head>

	<body>
		<div class="mui-content" id="content">

		</div>

		<div class="datatom-footer mui-hidden" id="footer" style="border-bottom: 1px solid #888;">
			<a id="remaind" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">催促处理</label>
			</a>
			<a id="comment" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">评价</label>
			</a>
			<a id="repeatingTask" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">转发</label>
			</a>
			<a id="responseTask" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">回复</label>
			</a>
			<a id="completeTask" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">完成</label>
			</a>

		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script src="../../js/feedback2.js" charset="UTF-8"></script>

		<script>
			mui.init({
				swipeBack: false
			});
			var policenum = getPolicenum();
			var realname = getRealname();
			var token = getToken();

			var id = <?php echo "'". $_GET["id"] . "'" ?>;
			//showWebviewToast("message>>"+id);
			//var id = 1;
			//var pageType = 1;
			var pageType = <?php echo "'". $_GET["pageType"] . "'" ?>;
			var policenumArr = "005025,005057,006663,005042,006661,005566,006607,006317";
			var taskname = "";
			var task = "";
			var pinfo = "";
			var data_key = "";
			//任务流程走了多少步
			var task_count = 0;

			function callByAndroid(json) {
				var arr = eval("(" + json + ")");
				var files = arr.files;
				var attachments = {}
				mui.each(files, function(index, item) {
					attachments.fileId = item.id;
					attachments.uploaderName = item.name;
					task.officeAttachment.push(attachments);
				});
				task.taskid = id;
				mui.ajax(basePath + '/apps/task/update', {
					data: JSON.stringify(task),
					beforeSend: function(request) {
						request.setRequestHeader("Content-Type", "application/json");
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						window.location.reload();
						showWebviewToast("添加附件成功");
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常");
					}
				});
			}

			(function($) {

				mui.ajax(basePath + '/osapi/task.php', {
					data: {
						action: 'getTaskDetails',
						taskid: id,
						type: pageType,
						policenum: policenum
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {

						if(data.code == "200") {
							var body = data.result;
							//是否执行了发送短信提醒的操作，如果没发送sendbool就是空，发送了就返回第几步进行操作
							var sendbool = data.sendbool;
							//				showWebviewToast("短信插入"+JSON.stringify(sendbool));
							if(sendbool == null) {
								showWebviewToast("尚未发送短信");
							} else {

							}
							taskname = body.taskname;
							//				showWebviewToast(JSON.stringify(body));
							task = body;
							pinfo = body.policeInfo;
							var bodyContent = document.getElementById('content');
							var htm = "";
							//				showWebviewToast(JSON.stringify(body));
							var policeInfo = body.policeInfo;
							htm += '<div class="mui-row"><div class="mui-col-sm-3 mui-col-xs-4" style="padding: 1rem;text-align:center;">';
							htm += '<img style="width: 100%;" src="' + basePath + '/osapi/avantar.php?policenum=' + body.creator + '"/>';
							htm += '<p style="text-align: center;margin-bottom: 0;font-weight: bold;">' + body.createorname + '</p>';
							htm += '</div><div class="mui-col-sm-9 mui-col-xs-8" style="padding: 1rem;">';
							htm += '<p class="datatom-task-name">' + body.taskname + '</p>';
							htm += '<p class="datatom-info">创建时间:<span>' + body.createtime + '</span></p>';
							htm += '<p class="datatom-info">开始时间:<span>' + body.starttime + '</span></p>';
							htm += '<p class="datatom-info">终止时间:<span>' + body.endtime + '</span></p>';
							htm += '<p class="datatom-info">任务类型:<span>' + body.taskTypeStr + '</span></p>';
							htm += '<p class="datatom-info">任务地点:<span>' + body.location + '</span></p>';
							htm += '<p class="datatom-info">任务等级:<span>' + body.taskLevelString + '</span></p>';
							htm += '<p class="datatom-info">任务状态:<span>' + body.taskStatusString + '</span></p>';
							htm += '</div></div>';
							if(policenumArr.indexOf(body.creator) > -1) {
								htm += '<div class="mui-row mui-text-center"><button type="button" class="mui-btn mui-btn-primary applyOverTime">申请加班</button></div>';
							}
							if(body.officeAttachment.length > 0) {
								htm += '<div class="mui-row datatom-task-title">';
								htm += '<span>附件列表：</span></div>';
								htm += '<div class="mui-row datatom-preimge" style="text-align: center;">';
								mui.each(body.officeAttachment, function(index, item) {
									htm += '<div class="mui-col-sm-4 mui-col-xs-3">';
									htm += '<img data-preview-src="" data-preview-group="1" style="width: 50px;height: 50px;" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item.fileId + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/>';
									htm += '</div>';
								});
								htm += '</div>';
							}
							htm += '<div class="mui-row datatom-task-title">';
							htm += '<span>任务内容：</span></div>';
							htm += '<div class="mui-row datatom-task-detail">';
							htm += '<p style="margin-bottom: 0;">' + body.detail + '</p>';
							htm += '</div><ul class="mui-table-view">';
							htm += '<li class="mui-table-view-cell mui-collapse mui-active">';
							htm += '<a class="mui-navigate-right" href="#">';
							htm += '<div class="datatom-task-title" style="padding-left: 0;">';
							htm += '<span>任务指派人</span></div></a>';
							htm += '<div class="mui-collapse-content">';
							htm += '<div class="mui-row" style="text-align: center;">';
							if(undefined != body.assignment) {
								var assignment = uniqueArray(body.assignment);
								var finishList = uniqueArray(body.finishList);
								mui.each(assignment, function(index, item) {
									htm += '<div class="mui-col-sm-4 mui-col-xs-3">';
									var flag = false;
									mui.each(finishList, function(index1, item1) {
										if(item == item1) {
											flag = true;
											htm += '<span style="position: absolute;right: 0;" class="mui-badge mui-badge-primary">完成</span>';
										}
									});
									if(!flag && policenum == body.creator) {
										data_key = item;
										htm += '<span data-key="' + item + '" style="position: absolute;right: 0;" class="mui-badge mui-badge-danger remindMessage">提醒</span>';
									}
									htm += '<img style="width: 50px;height: 50px;" src="' + basePath + '/osapi/avantar.php?policenum=' + item + '"/>';
									htm += '<p>' + getName(policeInfo, item) + '</p></div>';
								});
							}
							htm += '</div></div></li>';
							if(undefined != body.supervisor) {
								if(body.supervisor.length > 0) {
									htm += '<li class="mui-table-view-cell mui-collapse">';
									htm += '<a class="mui-navigate-right" href="#">';
									htm += '<div class="datatom-task-title" style="padding-left: 0;">';
									htm += '<span>任务监督人</span></div></a>';
									htm += '<div class="mui-collapse-content">';
									htm += '<div class="mui-row" style="text-align: center;">';
									var supervisor = uniqueArray(body.supervisor);
									mui.each(supervisor, function(index, item) {
										htm += '<div class="mui-col-sm-4 mui-col-xs-3">';
										htm += '<img style="width: 50px;height: 50px;" src="' + basePath + '/osapi/avantar.php?policenum=' + item + '"/>';
										htm += '<p>' + getName(policeInfo, item) + '</p></div>';
									});
									htm += '</div></div></li>';
								}
							}
							htm += '</ul>';
							htm += '<div class="mui-row datatom-task-title" style="padding-top:10px;padding-bottom:10px;">';
							htm += '<span>任务处理记录</span></div>';
							htm += '<div class="datatom-tline-box"><div class="datatom-tline" id="line">';
							//创建任务
							task_count++;
							htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
							htm += '<span class="mui-icon mui-icon-compose"></span>';
							htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
							htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + body.creator + '"/>';
							htm += '<p class="datatom-oprerate-title">' + body.createorname + '创建了任务<span class="mui-pull-right datatom-opreratetime">' + body.createtime + '</span></p>';
							htm += '<p class="datatom-oprerate-content">' + body.taskname + '</p></div></div></div>';
							//是否发送短信
							var temp_step = task_count + 1;
							if(sendbool != null) {
								mui.each(sendbool, function(index, item) {
									var step = item.step;
									if(temp_step == step) {
										temp_step++;
										task_count++;
										htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
										htm += '<span class="mui-icon mui-icon-chatbubble"></span>';
										htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
										htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + policenum + '"/>';
										htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, policenum) + '发送了催促处理短信</p>';
										htm += '<p class="datatom-oprerate-content"></p></div></div></div>';
									}
								});
							}
							//读取任务
							var readedList = uniqueArray(body.readedList);
							mui.each(readedList, function(index, item) {
								task_count++;
								//是否发送短信
								var temp_step = task_count + 1;
								if(sendbool != null) {
									mui.each(sendbool, function(index, item) {
										var step = item.step;
										if(temp_step == step) {
											temp_step++;
											task_count++;
											htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
											htm += '<span class="mui-icon mui-icon-chatbubble"></span>';
											htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
											htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + policenum + '"/>';
											htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, policenum) + '发送了催促处理短信</p>';
										}
									});
								}
								htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
								htm += '<span class="mui-icon mui-icon-eye"></span>';
								htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
								htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + item + '"/>';
								htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, item) + '读取了任务</p>';
								htm += '<p class="datatom-oprerate-content">' + getName(policeInfo, item) + '已读</p></div></div></div>';
							});
							//转发任务
							var operateList = body.operateList;

							mui.each(operateList, function(index, item) {
								if(item.operateType == "2") {
									task_count++;
									var temp_step = task_count + 1;
									if(sendbool != null) {
										mui.each(sendbool, function(index, item) {
											var step = item.step;
											if(temp_step == step) {
												task_count++;
												temp_step++;
												htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
												htm += '<span class="mui-icon mui-icon-chatbubble"></span>';
												htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
												htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + policenum + '"/>';
												htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, policenum) + '发送了催促处理短信</p>';
											}
										});
									}
									htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
									htm += '<span class="mui-icon mui-icon-redo"></span>';
									htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
									htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
									htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, item.policenum) + '转发了任务<span class="mui-pull-right datatom-opreratetime">' + item.logtime + '</span></p>';
									htm += '<p class="datatom-oprerate-content">' + item.comment + '</p></div></div></div>';
								}
							});
							//回复任务
							var msgToTaskList = body.msgToTaskList;
							mui.each(msgToTaskList, function(index, item) {
								task_count++;
								var temp_step = task_count + 1;
								if(sendbool != null) {
									mui.each(sendbool, function(index, item) {
										var step = item.step;
										if(temp_step == step) {
											task_count++;
											temp_step++;
											htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
											htm += '<span class="mui-icon mui-icon-chatbubble"></span>';
											htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
											htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + policenum + '"/>';
											htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, policenum) + '发送了催促处理短信</p>';
										}
									});
								}
								htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
								htm += '<span class="mui-icon mui-icon-chat"></span>';
								htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
								htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + item.fromPoliceNum + '"/>';
								htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, item.fromPoliceNum) + '回复了' + getName(policeInfo, item.toPoliceNum) + '<span class="mui-pull-right datatom-opreratetime">' + item.logtime + '</span></p>';
								htm += '<p class="datatom-oprerate-content">' + item.comment + '</p></div></div></div>';
							});
							//完成任务
							mui.each(operateList, function(index, item) {
								if(item.operateType == "4") {
									task_count++;
									htm += '<div class="datatom-time-node"><div class="datatom-node-status">';
									htm += '<span class="mui-icon mui-icon-checkmarkempty"></span>';
									htm += '</div><div class="datatom-node-box"><div class="arrow"></div>';
									htm += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
									htm += '<p class="datatom-oprerate-title">' + getName(policeInfo, item.policenum) + '完成了任务<span class="mui-pull-right datatom-opreratetime">' + item.logtime + '</span></p>';
									htm += '<p class="datatom-oprerate-content">' + item.comment + '</p></div></div></div>';
								}
							});
							//任务评价
							mui.ajax(basePath + '/osapi/appabnormal.php', {
								data: {
									action: 'gettaskinfo',
									taskid: id
								},
								beforeSend: function(request) {
									request.setRequestHeader("U-Auth-Token", token);
								},
								dataType: 'json', //服务器返回json格式数据
								type: 'post', //HTTP请求类型
								timeout: 10000, //超时时间设置为10秒；
								success: function(data2) {
									console.info('2-------');
									//									showWebviewToast('2-----------' + JSON.stringify(data2));
									if(data2.code == '200') {
										console.info("---------" + JSON.stringify(data2));
										var commentList = data2.result;
										console.info('-----------');
										var htm_comment = '';
										if(commentList == "" || commentList == []) {
											if(body.taskStatusString.indexOf("完成") > -1 && policenum == body.creator) {

												//任务还没评价
												document.getElementById("footer").classList.remove("mui-hidden");
												document.getElementById("comment").classList.remove("mui-hidden");
											}
										}
										mui.each(commentList, function(index, item) {
											console.info('-----------');
											htm_comment += '<div class="datatom-time-node"><div class="datatom-node-status">';
											htm_comment += '<span class="mui-icon mui-icon-flag"></span>';
											htm_comment += '</div><div class="datatom-node-box"><div class="arrow"></div>';
											htm_comment += '<div class="datatom-node-box-inner"><img src="' + basePath + '/osapi/avantar.php?policenum=' + body.creator + '"/>';
											htm_comment += '<p class="datatom-oprerate-title">' + body.createorname + '评价了任务<span class="mui-pull-right datatom-opreratetime">' + item.time + '</span></p>';

											htm_comment += '<p class="datatom-oprerate-content" style="float:left;width:400px">评价内容：' + item.content + '</p>';

											htm_comment += '	<p class="icons mui-inline"style="float:left;margin-top:8px">评分：';
											var star = item.star;
											for(var i = 0; i < star; i++) {
												htm_comment += '<i class="mui-icon mui-icon-star mui-icon-star-filled"></i>';
											}
											htm_comment += '</p>';
											htm_comment += '</div></div> </div></div> </div>';
										});

										document.getElementById('comment_line').innerHTML = htm_comment;
									} else {

									}

								},
								error: function(xhr, type, errorThrown) {
									showWebviewToast("网络错误");
								}
							});
							console.info('1-------');

							htm += '<div id="comment_line"></div></div></div><div style="height: 50px;background-color: #F6F5F1;"></div>';
							bodyContent.innerHTML = htm;
							//				showWebviewToast("目前一共" + task_count + "步");
							if(policenum == body.creator) {
								if(body.taskStatusString.indexOf("完成") > -1) {

								} else if(body.taskstatus != "0") {
									if(pageType == "send") {
										document.getElementById("remaind").classList.remove("mui-hidden");
									}
									document.getElementById("footer").classList.remove("mui-hidden");
									document.getElementById("repeatingTask").classList.remove("mui-hidden");
									document.getElementById("responseTask").classList.remove("mui-hidden");
									document.getElementById("completeTask").classList.remove("mui-hidden");
								} else {

									if(pageType == "send") {
										document.getElementById("remaind").classList.remove("mui-hidden");
									}
									document.getElementById("footer").classList.remove("mui-hidden");
									document.getElementById("repeatingTask").classList.remove("mui-hidden");
									document.getElementById("responseTask").classList.remove("mui-hidden");
								}

							} else {

								if(body.taskStatusString.indexOf("完成") > -1) {

								} else {
									if(pageType == "send") {
										document.getElementById("remaind").classList.remove("mui-hidden");
									}
									document.getElementById("footer").classList.remove("mui-hidden");
									document.getElementById("repeatingTask").classList.remove("mui-hidden");
									document.getElementById("responseTask").classList.remove("mui-hidden");
									document.getElementById("completeTask").classList.remove("mui-hidden");
								}
							}
						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});

				function uniqueArray(data) {
					data = data || [];
					var a = {};
					for(var i = 0; i < data.length; i++) {
						var v = data[i];
						if(typeof(a[v]) == 'undefined') {
							a[v] = 1;
						}
					};
					data.length = 0;
					for(var i in a) {
						data[data.length] = i;
					}
					return data;
				}

				function getName(arr, str) {
					var val = "";
					mui.each(arr, function(index, item) {
						if(item.policenum == str) {
							val = item.realname;
						}
					});
					return val;
				}

				//转发
				document.getElementById('repeatingTask').addEventListener("tap", function() {
					window.location.href = "taskforward.php?id=" + id;
				});

				//回复
				document.getElementById('responseTask').addEventListener("tap", function() {
					window.location.href = "taskresponse.php?id=" + id + "&pinfo=" + JSON.stringify(pinfo) + "&taskName=" + task.taskname;
				});

				//完成
				document.getElementById('completeTask').addEventListener("tap", function() {
					window.location.href = "finishTask.php?id=" + id;
				});
				//评价
				document.getElementById('comment').addEventListener("tap", function() {
					window.location.href = "comment.php?id=" + id;
				});

				mui("#content").on("tap", "button.applyOverTime", function() {
					window.javaInterface.itemApplyovertimework();
				});
				document.getElementById("remaind").addEventListener("tap", function() {
					var repolice = data_key;
					var smsMessage = realname + "提醒你看《" + taskname + "》任务";
					mui.confirm('发送短信请点击确认', '短信发送', ['取消', '确认'], function(e) {
						if(e.index == 1) {
							mui.ajax(basePath + '/osapi/task.php', {
								data: {
									action: "SMSNotice",
									message: smsMessage,
									policenum: repolice
								},
								beforeSend: function(request) {
									request.setRequestHeader("U-Auth-Token", token);
								},
								dataType: 'json', //服务器返回json格式数据
								type: 'POST', //HTTP请求类型
								timeout: 10000, //超时时间设置为10秒；
								success: function(data) {
									task_count++;
									mui.ajax(basePath + '/osapi/appabnormal.php', {
										data: {
											action: 'seavtasksendmess',
											taskid: id,
											step: task_count,
											sendpolicenum: '122',
											receivepolicenum: '1222'
										},
										dataType: 'json', //服务器返回json格式数据
										type: 'post', //HTTP请求类型
										timeout: 10000, //超时时间设置为10秒；
										success: function(data) {
											if(data.code == "200") {
												showWebviewToast("短信发送成功!");
												window.location.reload()
											} else {
												showWebviewToast("短信发送失败!" + data.code);
											}
										},
										error: function(xhr, type, errorThrown) {
											showWebviewToast("网络异常");
										}
									});
								},
								error: function(xhr, type, errorThrown) {
									showWebviewToast("网络异常");
								}
							});
						} else {
							showWebviewToast("已取消发送短信");
						}
					});
				});

				mui("#content").on("tap", "span.remindMessage", function() {
					var repolice = this.getAttribute("data-key");
					var smsMessage = realname + "提醒你看《" + taskname + "》任务";
					mui.confirm('发送短信请点击确认', '短信发送', ['取消', '确认'], function(e) {
						if(e.index == 1) {
							mui.ajax(basePath + '/osapi/task.php', {
								data: {
									action: "SMSNotice",
									message: smsMessage,
									policenum: repolice
								},
								beforeSend: function(request) {
									request.setRequestHeader("U-Auth-Token", token);
								},
								dataType: 'json', //服务器返回json格式数据
								type: 'POST', //HTTP请求类型
								timeout: 10000, //超时时间设置为10秒；
								success: function(data) {
									showWebviewToast("短信发送成功!");
								},
								error: function(xhr, type, errorThrown) {
									showWebviewToast("网络异常");
								}
							});
						} else {
							showWebviewToast("已取消发送短信");
						}
					});
				});

				setTitle("任务详情");
			})(mui);

			mui.previewImage();
		</script>
	</body>

</html>