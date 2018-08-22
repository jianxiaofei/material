<!--
作者：836110252@qq.com
时间：2016-05-29
描述：我的审批：考勤异常审批详情
-->
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>考勤异常审批详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->
		<link rel="stylesheet" href="../../../../css/mui.min.css">
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
			<div id="footer" class="datatom-footer mui-hidden">
				<a id="chexiao" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">撤销</label>
				</a>
				<a id="pass" class="datatom-item" href="javascript:;">
					<label class="datatom-label">同意</label>
				</a>
				<a id="nopass" class="datatom-item" href="javascript:;">
					<label class="datatom-label">否决</label>
				</a>
			</div>
		</div>
		<script src="../../../../js/mui.min.js"></script>
		<script src="../../../../js/common.js" charset="UTF-8"></script>
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
				var diff = <?php echo "'". $_GET["diff"] . "'" ?>;
				var policenum = getPolicenum();
				var token = getToken();
				mui.ajax(basePath + '/osapi/policeHelper.php', {
					data: {
						action: 'getInfoById',
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
							var item = data.result[0];
							var policenum_to = policenum_data;
							var date_to = item.time;
							var auditContent_to = "同意";
							console.info("item.realname>>"+item.realname);
							var content = document.getElementById('content');
							var html = '';
							html += '<div class="mui-content-padded"><div class="mui-row">';
							html += '<div class="mui-text-center mui-col-sm-2 mui-col-xs-3">';
							html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/></div>';
							html += '<div class="mui-col-sm-10 mui-col-xs-9">';
							html += '<p>' + item.realname + ' ('+item.policenum+')</p><p style="margin-bottom: 0;">' + item.workname + '</p></div></div></div>';
							html += '<div class="mui-content-padded">';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-12 mui-col-xs-12">';
							html += '<div class="mui-content-padded">';
							if(item.status == "1") {
								html += '<img class="datatom-img-tips" src="../../../../img/passapply.png"/>';
							} else if(item.status == "2") {
								html += '<img class="datatom-img-tips" src="../../../img/nopassapply.png"/>';
							} else if(item.status == "待申请") {
								html += '<img class="datatom-img-tips" src="../../../../img/waitapply.png"/>';
							}
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>异常日期：</label>';
							html += '</div><div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.time+'</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>异常内容：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.errortype + '</p></div></div>';
							html += '<div class="mui-row mui-text-center">';
							html += '<div class="mui-col-sm-3 mui-col-xs-4">';
							html += '<label>异常原因：</label></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-8">';
							html += '<p class="datatom-text-left">' + item.apply_content + '</p></div></div></div>';
							html += '<div class="datatom-line"></div>';
							//			showWebviewToast("diff>>"+diff);
							if(item.status =="待申请"|| item.status =="待审核") {
								var temp = document.getElementById("footer");
								removeClass(temp, "mui-hidden");
							} 
							content.innerHTML = html;
							//否决
							document.getElementById("nopass").addEventListener("tap", function() {
								mui.ajax(basePath + '/osapi/policeHelper.php', {
									data: {
										action: 'auditNoApply',
										id: id,
										date: date_to,
										status: 2,
										auditContent: "否决"
									},
									beforeSend: function(request) {
										request.setRequestHeader("U-Auth-Token", token);
									},

									dataType: 'json', //服务器返回json格式数据
									type: 'post', //HTTP请求类型
									timeout: 10000, //超时时间设置为10秒；
									success: function(data) {
										if(data.code == "200") {
											showWebviewToast("已经否决");
											mui.back();
										} else {
											showWebviewToast("提交失败");
										}
									},
									error: function(xhr, type, errorThrown) {
										showWebviewToast(data.msg);
									}
								});

							});
							//同意
							document.getElementById("pass").addEventListener("tap", function() {
								mui.ajax(basePath + '/osapi/policeHelper.php', {
									data: {
										action: 'auditNoApply',
										id: id,
										date: date_to,
										status: 1,
										auditContent: "同意"
									},
									beforeSend: function(request) {
										request.setRequestHeader("U-Auth-Token", token);
									},

									dataType: 'json', //服务器返回json格式数据
									type: 'post', //HTTP请求类型
									timeout: 10000, //超时时间设置为10秒；
									success: function(data) {
										if(data.code == "200") {
											showWebviewToast("已经同意");
											mui.back();
										} else {
											showWebviewToast("提交失败");
										}
									},
									error: function(xhr, type, errorThrown) {
										showWebviewToast(data.msg);
									}
								});
							});

						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});

				setTitle('考勤异常审批详情'); //设置title

			})(mui);
		</script>
	</body>

</html>