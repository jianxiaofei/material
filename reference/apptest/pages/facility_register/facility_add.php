<!--
	作者：Alex
	时间：2017-03-25
	描述：新增设施
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>新增设施</title>
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
			
			.mui-content textarea {
				height: 100px;
				margin-bottom: 0 !important;
				padding-bottom: 0 !important;
				border: none !important;
			}
			
			.mui-content input {
				border: none !important;
			}
			
			.attachment-list img {
				width: 20px !important;
				height: 20px !important;
				line-height: 20px !important;
			}
			
			.datatom-icon-delete {
				color: red;
			}
			
			.mui-content-padded {
				position: relative;
				padding-left: 0;
				list-style: none;
				background-color: #fff;
				margin: 0;
			}
			
			.datatom-row {
				position: relative;
				overflow: hidden;
				padding: 11px 15px;
				-webkit-touch-callout: none;
			}
			
			.datatom-row:after {
				position: absolute;
				right: 0;
				bottom: 0;
				left: 15px;
				height: 1px;
				content: '';
				-webkit-transform: scaleY(.5);
				transform: scaleY(.5);
				background-color: #c8c7cc;
				display: inline-block;
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
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-fullscreen" id="mui-content">
			
			<p>事件内容</p>
			<div class="row mui-input-row">
				<textarea id="content" class="mui-input-clear content" placeholder="请输入事件内容"></textarea>
			</div>
			<p>任务要求</p>
			<div class="row mui-input-row">
				<textarea id="request" class="mui-input-clear content" placeholder="请输入任务要求"></textarea>
			</div>
			<p>事件发生地</p>
			<div class="row mui-input-row">
				<textarea id="location" class="mui-input-clear content" placeholder="请输入事件发生地"></textarea>
			</div>
			<div class="mui-content">
			<p>任务等级</p>
			<div class="row mui-input-row">
				<form class="mui-input-group">
					<div class="mui-input-row mui-radio mui-left">
						<label>普通</label>
						<input id="level1" name="radio1" type="radio" checked>
					</div>
					<div class="mui-input-row mui-radio mui-left">
						<label>紧急</label>
						<input id="level2" name="radio1" type="radio" >
					</div>
					<div class="mui-input-row mui-radio mui-left ">
						<label>加急</label>
						<input id="level3" name="radio1" type="radio" >
					</div>
				</form>
			</div>
			<ul class="mui-table-view mui-hidden">
				<li class="mui-table-view-cell" style="padding:0;" id="selectFile">
					<div class="mui-input-row">
						<label style="color: #888;">选择附件</label>
						<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
					</div>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell" style="padding:0;" id="selectFile">
					<div class="mui-input-row">
						<a  class=" mui-input-row "  href="#bottomPopover" style="width: 80%;text-decoration:none">
							<label class="datatom-label" style="width: 80%;">选择附件</label>
						</a>
						<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
					</div>
				</li>
			</ul>
			<div class="mui-content-padded" id="attachment-list">

			</div>
			<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
				<button id="submitAddNotice" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
			</div>
			<div id="bottomPopover" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
			</ul>
			<!--<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>-->
		</div>
		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
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

			var token = getToken();
			var policenum = getPolicenum();
			var realname = getRealname();
			var department = getDepartmentid();
			var userico = getUserid();
			var special_notice_creator = ["005985"];
			var attachments_id=[];
			var attachments = [];
			var taskLeve=1;
			var attachmentStr="";
			function callByAndroid(json) {
//				mui.toast(json);
				var arr = eval("(" + json + ")");
				var files = arr.files;
				attachments = files;
				var length = files.length;
				for(var i = 0; i < length; i++) {
					var item = files[i];
					var fname = item.name;
					attachments_id.push(item.id);
					var sonDiv = document.createElement("div");
					sonDiv.className = "mui-row datatom-row";
					sonDiv.innerHTML = '<div class="mui-col-sm-1 mui-col-xs-1 mui-text-center">' +
						'<img width="20px" height="20px" data-preview-src="" data-preview-group="1" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item.id + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/>' +
						'</div><div class="mui-col-sm-10 mui-col-xs-10">' +
						'<p style="margin: 0;padding: 0;">' + fname.substring(fname.length - 20, fname.length) + '</p>' +
						'</div><div class="mui-col-sm-1 mui-col-xs-1 mui-text-center">' +
						'<span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="' + item.id + '"></span>' +
						'</div>';
					document.getElementById('attachment-list').appendChild(sonDiv);
				}
			}
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
			
			//删除附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-list").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.remove();
				var key = this.getAttribute("data-key");
				var arr = [];
				var arr_id=[];
				mui.each(attachments, function(index, item) {
					if(item.id != key) {
						arr.push(item);
						arr_id.push(item.id);
					}
				});
				attachments = arr;
				attachments_id=arr_id;
			});
			(function($) {
			//添加附件
			document.getElementById('selectFile').addEventListener("tap", function() {
				window.javaInterface.doFileSelect();
			});

			//保存设备上报信息
			document.getElementById("submitAddNotice").addEventListener("tap", function() {
					var content = document.getElementById("content").value;
					var imageurls = JSON.stringify(attachments);
					var taskRequest=document.getElementById("request").value;
					var task_location=document.getElementById("location").value;
					if("" == content || null == content) {
						mui.toast("内容不能为空!");
						return;
					}
					if(""==task_location || null==task_location)
					{
						mui.toast("任务地点不能为空");
					}
					if(""==taskRequest || null==taskRequest)
					{
						mui.toast("任务要求不能为空");
					}
					var radioStatus="1";
					var radio1=document.getElementById("level1").checked;
					var radio2=document.getElementById("level2").checked;
					var radio3=document.getElementById("level3").checked;
					if(radio1==true){
						radioStatus="1";
					}else if(radio2==true)
					{
						radioStatus="2";
					}else{
						radioStatus="3";
					}
					attachmentStr=attachments_id.join(",");
					mui.toast(attachmentStr);
					mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
						data: {
						action: 'addTaskOfApp',
						faultcontent:content,
						location:task_location,
						policenum:policenum,
						realname:realname,
						remarks:taskRequest,
						level:radioStatus,
						enclosureid:attachmentStr,
						
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
							mui.back();
							mui.toast("发布成功!");
						} else {
							mui.toast("发布失败!");
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常");
					}
				}
				);
			});
			setTitle("新增设施上报");
			})(mui);
			mui.previewImage();
		</script>
	</body>

</html>