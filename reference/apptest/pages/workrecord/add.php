<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>新增工作记录</title>
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
						工作时间：
					</p>
				</div>
				<div class="mui-col-sm-9 mui-col-xs-8">
					<p id="addTime"></p>
				</div>
			</div>
			<div class="mui-row">

				<div class="mui-col-sm-3 mui-col-xs-4">
					<p style="text-align: right;">
						工作内容：
					</p>
				</div>

			</div>
			<div class="mui-row">
				<div class="mui-col-sm-1 mui-col-xs-1">

				</div>
				<div class="mui-col-sm-10 mui-col-xs-10">
					<textarea id="textarea" cols="*" rows="13" placeholder="请输入工作内容(必填)"></textarea>
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
				<!--
				<li class="mui-table-view-cell mui-media">
				<a class="attachment-list">
				<img class="mui-media-object mui-pull-left" src="../../img/txt.png"/>
				<div class="mui-media-body">123<p class="mui-pull-right"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete"></span></p>
				</div>
				</a>
				</li>-->
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
			var date = <?php echo "'". $_GET["date"] . "'" ?>;
			var attachments = [];

			function callByAndroid(json) {
				var arr = eval("(" + json + ")");
				var files = arr.files;
				attachments = files;
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
						arr.push(item);
					}
				});
				attachments = arr;
			});

			document.getElementById('addTime').innerHTML = date;
			(function($) {
				//添加附件
				document.getElementById('selectFile').addEventListener("tap", function() {
					window.javaInterface.doFileSelect();
				});

				document.getElementById("submitAddWorkLog").addEventListener("tap", function() {
					var content = document.getElementById('textarea').value;
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
					var worktime = date + " " + getHHMMSS();
					var entity = {};
					var Arr = [];
					mui.each(attachments, function(index, item) {
						Arr.push(item.id);
					});
					entity.attachements = Arr;
					entity.createtime = worktime.substring(0, 16);
					entity.logtime = logtime.substring(0, 16);
					entity.finishtime = worktime.substring(0, 16);
					entity.starttime = worktime.substring(0, 16);
					entity.policenum = policenum;
					var detail = {};
					detail.text = content;
					detail.type = "0";
					var con = [];
					con.push(detail);
					entity.detail = JSON.stringify(con);
					mui.ajax(basePath + '/apps/task/note/add', {
						data: JSON.stringify(entity),
						beforeSend: function(request) {
							request.setRequestHeader("Content-Type", "application/json");
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							window.javaInterface.startWorkLogActivity();
							showWebviewToast("工作日志添加成功");
						},
						error: function(xhr, type, errorThrown) {
							showWebviewToast("网络异常:xhr:"+xhr+" type :"+type+"errorThrown"+errorThrown);
						}
					});
				});

				setTitle("新增工作日志");
			})(mui);
		</script>
	</body>

</html>