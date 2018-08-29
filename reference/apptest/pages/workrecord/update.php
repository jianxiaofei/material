<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>修改工作记录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" href="../../css/iconfont.css" />
		<style>
			.mui-content p {
				padding: 10px 15px 0;
			}
			
			textarea::-webkit-input-placeholder {
				color: #888 !important;
				font-size: 14px !important;
			}
			
			textarea:-moz-placeholder {
				color: #888 !important;
				font-size: 14px !important;
			}
			
			textarea::-moz-placeholder {
				color: #888 !important;
				font-size: 14px !important;
			}
			
			textarea:-ms-input-placeholder {
				color: #888 !important;
				font-size: 14px !important;
			}
			/*自适应文本框高度*/
			
			.chackTextarea-area {
				min-height: 200px;
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
			
			.attachment-list img {
				width: 20px !important;
				height: 20px !important;
				line-height: 20px !important;
			}
			
			.datatom-icon-delete {
				color: red;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content">
			<div class="mui-row">
				<div class="mui-col-sm-3 mui-col-xs-4">
					<p style="text-align: right;">
						工作日期：
					</p>
				</div>
				<div class="mui-col-sm-9 mui-col-xs-8">
					<p id="addTime">

					</p>
				</div>

			</div>
			<div class="mui-row" style="margin-bottom: 10px;">
				<div class="mui-col-sm-3 mui-col-xs-4">
					<p style="text-align: right;">
						工作内容：
					</p>
				</div>
				
				<div class="mui-col-sm-1 mui-col-xs-1"></div>
			</div>
			<div class="mui-row" style="margin-bottom: 10px;">
				<div class="mui-col-sm-1 mui-col-xs-1"></div>
				<div class="mui-col-sm-10 mui-col-xs-10">
					<div class="chackTextarea-area" contenteditable="true" id="textarea">
						
					</div>
				</div>
				<div class="mui-col-sm-1 mui-col-xs-1"></div>
			</div>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell" style="padding:0;" id="selectFile">
					<div class="mui-input-row">
						<label style="color: #888;">选择附件</label>
						<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
					</div>
				</li>
			</ul>
			<ul id="attachment-list" class="mui-table-view">

			</ul>
			<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
				<button id="submitAddWorkLog" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">
				提交
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
			var id = <?php echo "'". $_GET["id"] . "'" ?>;
			//var id=1;
			var temp2 = "";
			var attachments = [];

			function callByAndroid(json) {
				var arr = eval("(" + json + ")");
				var temp = [];
				var files = arr.files;
				mui.each(files, function(index, item) {
					attachments.push(item.id);
				});
				var length = files.length;
				for(var i = 0; i < length; i++) {
					var item = files[i];
					var fname = item.name;
					var li = document.createElement('li');
					li.className = "mui-table-view-cell mui-media";
					li.innerHTML += '<a class="attachment-list">' +
						'<img class="mui-media-object mui-pull-left" src="../../img/txt.png"/>' +
						'<div class="mui-media-body">' + fname.substring(fname.length - 20, fname.length) + '<p class="mui-pull-right" style="padding:0px;"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="' + item.id + '"></span></p>' +
						'</div></a>';
					document.getElementById('attachment-list').appendChild(li);
				}
			}

			//删除附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-list").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				var key = this.getAttribute("data-key");
				var arr = [];
				mui.each(attachments, function(index, item) {
					if(item.id != key) {
						arr.push(item.id);
					}
				});
				attachments = arr;
			});

			(function($) {

				var Arr = [];
				mui.ajax(basePath + '/osapi/worklog.php', {
					data: {
						action: 'getWorklogDetail',
						id: id
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'post', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
//							 showWebviewToast(JSON.stringify(data));
							var result = data.result;
							var html = "";
							var text = eval("(" + result.detail + ")");
							if(result.attachements.length > 0) {
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<p>附件列表：</p></div>';
								html += '<div class="mui-row mui-col-sm-9 mui-col-xs-8">';
								mui.each(result.attachements, function(index, item) {
									var fname = item;
									attachments.push(item);
									html += '<div class="mui-col-sm-4 mui-col-xs-3">';
									html += '<img data-preview-src="" data-preview-group="1" width="150px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
								});
								html += '</div></div>';
							}
							
							temp2 = result.finishtime;
							document.getElementById('addTime').textContent = result.finishtime;
							document.getElementById('textarea').textContent = text[0].text;
							document.getElementById('attachment-list').innerHTML = html;
							document.getElementById("submitAddWorkLog").addEventListener("tap", function() {
								var content = document.getElementById('textarea').textContent;
								//		showWebviewToast("textarea"+content);
								if(null == content || "" == content || undefined == content) {
									showWebviewToast("请输入工作日志内容");
									return;
								}

								var length = content.length;
								//				不能少于25个字
								if(length < 25) {
									var temp = 25 - length;
									showWebviewToast("工作日志内容还需要输入" + temp + "个字符");
									return;
								}
								var logtime = getNowFormatDate() + " " + getHHMMSS();

								var worktime = temp2;


								var entity = {};
								var Arr = [];

								mui.each(attachments, function(index, item) {
									Arr.push(item);
								});
								entity.attachements = Arr;
								entity.createtime = worktime.substring(0, 16);
								entity.logtime = worktime.substring(0, 16);
								entity.finishtime = worktime.substring(0, 16);
								entity.starttime = worktime.substring(0, 16);
								entity.policenum = policenum;
								entity.taskid = id;
								var detail = {};
								detail.text = content;
								detail.type = "0";
								var con = [];
								con.push(detail);
								entity.detail = JSON.stringify(con);

								mui.ajax(basePath + '/apps/task/note/update', {
									data: JSON.stringify(entity),
									beforeSend: function(request) {
										request.setRequestHeader("Content-Type", "application/json");
									},
									dataType: 'json', //服务器返回json格式数据
									type: 'POST', //HTTP请求类型
									timeout: 10000, //超时时间设置为10秒；
									success: function(data) {

										window.javaInterface.finishActivity();
										window.javaInterface.startWorkLogActivity();
										//                      window.javaInterface.back(basePath + '/extapp/app/html5/workrecord/index.php');
										showWebviewToast("工作日志修改成功");
									},
									error: function(xhr, type, errorThrown) {
										showWebviewToast("网络异常");
									}
								});
							});

						} else {
							showWebviewToast("获取失败：" + data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络错误：");
					}
				});
				//添加附件
				document.getElementById('selectFile').addEventListener("tap", function() {
					window.javaInterface.doFileSelect();
				});

				setTitle("修改工作日志");
			})(mui);
		</script>
	</body>

</html>