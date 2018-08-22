<!--
作者：836110252@qq.com
时间：2016-07-25
业务描述：1、任务分发在PC端进行；如果PC端分发给大队的，则消息发给大队同时发给大队长
2、大队长分发任务
3、执行民警收到任务
4、每次转发如果对应到人都要发短信以及app消息
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" href="../../css/iconfont.css"/>
		<link rel="stylesheet" href="../../css/prew_picture.css" />
		<style>.mui-plus header.mui-bar {
	display: none!important;
}

.mui-plus .mui-bar-nav~.mui-content {
	padding: 0!important;
}

.mui-plus .plus {
	display: inline;
}

.plus {
	display: none;
}

#topPopover {
	position: fixed;
	top: 16px;
	right: 6px;
}

#topPopover .mui-popover-arrow {
	left: auto;
	right: 6px;
}

p {
	text-indent: 22px;
}

.mui-badge {
	text-indent: 2px;
}

span.mui-icon {
	font-size: 14px;
	color: #007aff;
	margin-left: -15px;
	padding-right: 10px;
}

.mui-popover {
	height: 100px;
}

.mui-content {
	padding: 10px;
}

.mui-content {
	padding-bottom: 44px;
}

.mui-media-object {
	border-radius: 50%;
}

.mui-content-padded {
	background-color: #fff;
	margin: 0;
	padding: 10px;
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

.mui-content-padded label {
	color: #888;
	font-size: .8rem;
}

.datatom-timeline {
	position: relative;
	margin: 0;
	padding: 0;
	list-style: none;
	padding: 0;
	padding-left: 15px;
	padding-right: 15px;
	padding-top: 15px;
}

.datatom-timeline:before {
	content: '';
	position: absolute;
	top: 0px;
	bottom: 0;
	width: 1px;
	background: #ddd;
	left: 42px;
	margin: 0;
	border-radius: 2px;
}

.datatom-timeline li {
	position: relative;
	margin-bottom: 15px;
}

.datatom-timeline> li> .datatom-timeline-item {
	margin-top: 0px;
	background: #fff;
	color: #444;
	margin-left: 40px;
	padding: 0;
	position: relative;
}

.iconfont {
	width: 3rem;
	height: 3.6rem;
	line-height: 3rem;
	position: absolute;
	border-radius: 50%;
	text-align: center;
	left: 1%;
	top: 11%;
}

.mui-pull-right {
	font-size: .5rem;
}

.datatom-triangle {
	height: 0px;
	width: 0px;
	border-width: 8px;
	border-style: solid;
	position: absolute;
	top: 6px;
	border-color: transparent #fff transparent transparent;
	left: -16px;
}

.datatom-img img {
	width: 50px;
}</style>
	</head>
	<body class="mui-fullscreen">
		<div class="mui-content" id="content">

		</div>
		<div class="datatom-footer" id="footer" style="border-bottom: 1px solid #888;">
			<a id="acceptTask" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">接收</label>
			</a>

			<a id="startTask" class="datatom-item mui-hidden" href="#bottomPopover">
				<label class="datatom-label">签到</label>
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
			<a id="judgmentsTask" class="datatom-item mui-hidden" href="javascript:void(0);">
				<label class="datatom-label">评价</label>
			</a>
		</div>

		<div id="bottomPopover" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>
		</div>

		<script src="../../js/mui.min.js"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
mui.init();
var id =<?php echo "'". $_GET["id"] . "'" ?>;
var token = getToken();
var policenum = getPolicenum();
var realname = getRealname();

function callByAndroid(json) {
	var arr = eval("(" + json + ")");
	var files = arr.files;
	var attachments = [];
	attachments = files;
	var length = files.length;
	var attachmentsArr = [];

	mui.each(attachments, function(index, item) {
		attachmentsArr.push(item.id);
		//showWebviewToast(policenum+">>"+id+">>"+realname+">>"+attachmentsArr);
	});

	mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
		data: {
			action: 'signTask',
			policenum: policenum,
			taskid: id,
			name: realname,
			usernum: "",
			username: "",
			content: "",
			enclosureid: attachmentsArr.join(",")
		},
		beforeSend: function(request) {
			request.setRequestHeader("U-Auth-Token", token);
		},
		dataType: 'json', //服务器返回json格式数据
		type: 'post', //HTTP请求类型
		timeout: 10000, //超时时间设置为10秒；
		success: function(data) {
			if(data.code == "200") {
				window.location.reload();
				showWebviewToast("任务签到成功!");
			} else {
				showWebviewToast(data.msg);
			}
		},
		error: function(xhr, type, errorThrown) {
			showWebviewToast("网络异常");
		}
	});

}
(function($) {

	mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
		data: {
			action: 'detailTask',
			taskid: id,
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
				var content = document.getElementById('content');
				var html = "";
				var info = data.result.base;
				//根据不同的人生成不同的按钮
				var footer = document.getElementById('footer');

				if(info.state == 1) {
					document.getElementById('acceptTask').classList.remove("mui-hidden");
				} else if(info.state == 8 || info.state == 3 || info.state == 4 || info.state == 5) {
					document.getElementById('repeatingTask').classList.remove("mui-hidden");
					document.getElementById('responseTask').classList.remove("mui-hidden");
					document.getElementById('completeTask').classList.remove("mui-hidden");
				} else if(info.state == 2) {
					document.getElementById('repeatingTask').classList.remove("mui-hidden");
					document.getElementById('startTask').classList.remove("mui-hidden");
				} else {
					document.getElementById('judgmentsTask').classList.remove("mui-hidden");
				}

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
				showWebviewToast(data.msg);
			}
		},
		error: function(xhr, type, errorThrown) {
			showWebviewToast("网络异常!");
		}
	});
	//签到
	mui('body').on('click', '.mui-popover li>a', function(e) {
		var a = this,
			parent;
		//根据点击按钮，反推当前是哪个actionsheet
		for(parent = a.parentNode; parent != document.body; parent = parent.parentNode) {
			if(parent.classList.contains('mui-popover-action')) {
				break;
			}
		}

		if(a.innerText == "相机拍照") {
			window.javaInterface.doPhonePictuer();
		} else {
			window.javaInterface.doPictuerSelect();
		}
		//关闭actionsheet
		mui('#' + parent.id).popover('toggle');

		//	info.innerHTML = "你刚点击了\"" + a.innerHTML + "\"按钮";
	});
	//接收任务
	document.getElementById('acceptTask').addEventListener("tap", function() {
		mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
			data: {
				action: 'acceptTask',
				taskid: id,
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
					window.location.reload();
					showWebviewToast("任务接收成功!");
				} else {
					showWebviewToast(data.msg);
				}
			},
			error: function(xhr, type, errorThrown) {
				showWebviewToast("网络异常");
			}
		});
	});
	//转发
	document.getElementById('repeatingTask').addEventListener("tap", function() {
		window.location.href = "repeating.php?id=" + id;
	});
	//回复
	document.getElementById('responseTask').addEventListener("tap", function() {
		window.location.href = "response.php?id=" + id;
	});
	//完成任务
	document.getElementById('completeTask').addEventListener("tap", function() {
		mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
			data: {
				action: 'completeTask',
				taskid: id,
				policenum: policenum,
				name: realname
			},
			beforeSend: function(request) {
				request.setRequestHeader("U-Auth-Token", token);
			},
			dataType: 'json', //服务器返回json格式数据
			type: 'POST', //HTTP请求类型
			timeout: 10000, //超时时间设置为10秒；
			success: function(data) {
				if(data.code == "200") {
					window.location.reload();
					showWebviewToast("任务完成!");
				} else {
					showWebviewToast(data.msg);
				}
			},
			error: function(xhr, type, errorThrown) {
				showWebviewToast("网络异常");
			}
		});
	});
	//评价
	document.getElementById('judgmentsTask').addEventListener("tap", function() {
		window.location.href = "judgments.php?id=" + id;
	});

	setTitle("任务处理详情");
})(mui);
mui.previewImage();</script>
	</body>
</html>
