<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>我的工作记录</title>
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
			
			.add_tzgg {
				width: 55px!important;
				height: 55px!important;
				border-radius: 50%;
				position: fixed;
				right: 2%;
				bottom: 2%;
				z-index: 100;
			}
			
			
			.mui-navigate-right {
				padding-right: 2px;
			}
			/*.right{
				background-color:#000088 ;
			}*/
			
		</style>
	</head>

	<body class="mui-fullscreen">
		<header class="mui-bar mui-bar-nav" style="padding-left: 0;">
			<h1 class="mui-title" style="text-align: left;left: 15px;" id="title"></h1>
		</header>
		<div class="mui-content">
			<ul class="mui-table-view mui-table-view-chevron" style="margin-top: 0;" id="worklog-list"></ul>
			<div class="mui-block" style="position: absolute;width: 100%;bottom: 0px;text-align: center;">
				<button type="button" class="mui-btn mui-btn-primary add_tzgg" style="width: 90%;height: 46px;" id="addWorkLog">
				<h1 style="margin: auto;">+</h1>
				</button>
			</div>
		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
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
			var policenum = getPolicenum();
			var token = getToken();
			var currentdate = getNowFormatDate();
			var sysDate = getNowFormatDate();
			//是他自己的，还是别人的
			var isFromOther = false;

			function callByAndroid(json) {
				var arr = eval("(" + json + ")");
				currentdate = arr.date;
				getData();
			}

			function getData() {
				showH5Loading();
//				isFromOther = window.javaInterface.isFromOther();
				mui.ajax(basePath + '/osapi/worklog.php', {
					data: {
						action: 'getWorklogByDay',
						policenum: policenum,
						date: currentdate
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						dismissH5Loading();
						if(data.code == "200") {
							document.getElementById('title').innerHTML = currentdate + '工作记录列表';
							sysDate = data.result.systime;
							var list = data.result.data;
							var length = list.length;
							var table = document.body.querySelector('.mui-table-view');
							table.innerHTML = "";
							var fragment = document.createDocumentFragment();
							if(0 == length) {
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								li.innerHTML = '今日无工作日志记录';
								fragment.appendChild(li);
							}
							mui.each(list, function(index, item) {
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell ';
								var html = "";
								
									html += '<div class="mui-slider-right mui-disabled">'
									html += '<a class = "mui-btn mui-btn-red delete" > 删除 </a>';
									html += '<a class = "mui-btn mui-btn-blue change" > 编辑</a></div>';
//								}
								html += '<div class="mui-slider-handle ">';
								html += '<a  class="right" data-taskid="' + item.taskid + '" data-key="' + item.id + '">';
								var detail = eval("(" + item.detail + ")");
								var detailStr = detail[0].text.length > 8 ? detail[0].text.substring(0, 16) + '...' : detail[0].text;
								html += '<div class="mui-media-body">' + detailStr;
								html += '<p class="mui-ellipsis">';
								if(item.attachements > 0) {
									html += '<span class="mui-badge mui-badge-warning">有附件</span>';
								}
								html += '<span class="mui-pull-right">' + item.finishtime + '</span></p>';
								html += '</div></a></div>';
								li.innerHTML = html;
								fragment.appendChild(li);
							});
							table.appendChild(fragment);

						} else {
							showWebviewToast(data.msg);
						}

					},
					error: function(xhr, type, errorThrown) {
						dismissH5Loading();
						showWebviewToast("网络异常!");
					}
				});
			}

			(function($) {
				getData();

				document.getElementById('addWorkLog').addEventListener("tap", function() {
					if(currentdate > sysDate) {
						showWebviewToast("添加工作记录的日期不能超过今天!");
						return;
					}
					window.javaInterface.startDefaultHtmlActivity(basePath + '/extapp/app/html5/workrecord/add.php?date=' + currentdate);
				});
				

				mui("#worklog-list").on("tap", "a.right", function() {
					//获取id
					var id = this.getAttribute("data-key");
					var task = this.getAttribute("data-taskid");

					window.javaInterface.startDefaultHtmlActivity(basePath + '/extapp/app/html5/workrecord/detail.php?id=' + id);
				});

				var btnArray = ['确认', '取消'];

				//第一个demo，拖拽后显示操作图标，点击操作图标删除元素；
				$('#worklog-list').on('tap', '.delete', function(event) {
					var elem = this;
					var li = elem.parentNode.parentNode;
					var taskid_id = li.getElementsByClassName("right")[0].getAttribute("data-key");

					mui.confirm('确认删除该条记录？', '工作记录', btnArray, function(e) {
						if(e.index == 0) {
							mui.ajax(basePath + '/osapi/worklog.php', {
								data: {
									action: 'delworklogByid',
									id: taskid_id
								},
								dataType: 'json', //服务器返回json格式数据
								type: 'post', //HTTP请求类型
								timeout: 10000, //超时时间设置为10秒；
								beforeSend: function(request) {
									request.setRequestHeader("U-Auth-Token", token);
								},
								success: function(data) {
									dismissH5Loading();

									if(data.code == "200") {
										showWebviewToast("删除成功!");
										li.parentNode.removeChild(li);
									} else {
										showWebviewToast("删除失败!");
									}
								},

								error: function(xhr, type, errorThrown) {
									dismissH5Loading();
									showWebviewToast("网络异常!" + ">>" + xhr + ">>");
								}
							});
						} else {
							setTimeout(function() {
								$.swipeoutClose(li);
							}, 0);
						}
					});
				});
				$('#worklog-list').on('tap', '.change', function(event) {
					var elem = this;
					var li = elem.parentNode.parentNode;
					var taskid_id = li.getElementsByClassName("right")[0].getAttribute("data-key");

					window.javaInterface.startDefaultHtmlActivity(basePath + '/extapp/app/html5/workrecord/update.php?id=' + taskid_id);
				});

			})(mui);
		</script>
	</body>

</html>