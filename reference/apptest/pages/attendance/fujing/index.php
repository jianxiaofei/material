
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>辅警异常审批列表</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->

		<link rel="stylesheet" href="../../../css/mui.min.css">
		<link rel="stylesheet" href="../../../css/iconfont.css" />
		<style>
			html,
			body,
			.mui-content {
				color: #888;
				background-color: #FFF;
			}
			
			.mui-slider .mui-segmented-control.mui-segmented-control-inverted~.mui-slider-group .mui-slider-item {
				border: none;
			}
			
			.list-status {
				position: absolute;
				right: 8%;
				width: 10% !important;
				top: 0;
			}
			
			img {
				border-radius: 50%;
				float: left;
				width: 45px;
				height: 45px;
			}
			
			span {
				float: left;
				width: 45px;
				height: 45px;
				margin-left: 5px;
			}
			
			.mui-table-view .mui-active {
				background-color: #FFF;
				!important
			}
			
			.datatom-tran {
				top: 10%;
				transform: rotate(-27deg);
				-ms-transform: rotate(-27deg);
				/* IE 9 */
				-moz-transform: rotate(-27deg);
				/* Firefox */
				-webkit-transform: rotate(-27deg);
				/* Safari 和 Chrome */
				-o-transform: rotate(-27deg);
				/* Opera */
			}
			
			.mui-ellipsis {
				font-size: .8rem;
			}
			
			.mui-pull-right-time {
				font-size: .8rem;
			}
			
			.mui-media-body {
				font-size: .75rem;
				color: #888;
				margin-top: 1px;
				margin-left: 60px;
			}
			
			.datatom-out {
				font-size: 34px;
				color: #555555;
			}
			
			.datatom-wait {
				font-size: 34px;
				color: #f9c909;
			}
			
			.datatom-pass {
				font-size: 34px;
				color: #39af6f;
			}
			
			.datatom-nopass {
				font-size: 34px;
				color: #ef5350;
			}
		</style>
	</head>

	<body>
		<div class="mui-content ">
			<div id="slider" class="mui-slider mui-fullscreen">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item item1mobile" id="xiaoxi" href="#item1mobile">
						考勤自动提交
					</a>
					<a class="mui-control-item item2mobile" id="tesks" href="#item2mobile">
						考勤手动申请
					</a>
					<a class="mui-control-item item2mobile" id="tesks" href="#item3mobile">
						工作日志异常
					</a>
				</div>
				<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>
				<div class="mui-slider-group">
					<div id="item1mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content mui-active">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron" id="kaoqin">

							</ul>
						</div>
					</div>
					<div id="item2mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content ">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron" id="kaoqin2">

							</ul>
						</div>
					</div>
					<div id="item3mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron" id="jiaban">

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init({
				swipeBack: false
			});
			(function($) {
				var policenum = getPolicenum();
				var token = getToken();
				var currentDate = getNowFormatDate();
				var current = new Date(currentDate);
				Date.prototype.diff = function(date) {
					return(this.getTime() - date.getTime()) / (24 * 60 * 60 * 1000);
				}
				var size = 10;
				var kqpage = 1;
				var qjpage = 1;
				var jbpage = 1;
				//待审核 #f9c909
				//通过 #39af6f
				//不通过 #ef5350

				//我的审批-考勤（自动）
				mui('#item1mobile').pullRefresh({

					down: {
						contentrefresh: "正在加载...",
						callback: kqPullDownRefresh
					}
				});

				//我的审批-考勤（手动）
				mui('#item2mobile').pullRefresh({
					down: {
						contentrefresh: "正在加载...",
						callback: qjPullDownRefresh
					}
				});

				//我的申请-加班
				mui('#item3mobile').pullRefresh({
					down: {
						contentrefresh: "正在加载...",
						callback: jbPullDownRefresh
					}
				});

				//我的审批（自动）
				function kqPullDownRefresh() {
					kqpage = 1;
					mui.ajax(basePath + '/osapi/policeHelper.php', {
						data: {
							action: 'getAuditNoApply',
							blamepolicenum: policenum,
							type: 0
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {

							if(data.code == "200") {
								var list = data.result;
								var length = list.length;
								var ul = document.getElementById('kaoqin');
								var fragment = document.createDocumentFragment();
								ul.innerHTML = "";
								mui.each(list, function(index, item) {

									var apply_date = new Date(item.apply_time);
									var diff_count = current.diff(apply_date);
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-media";
									var html = "";
									html += '<a class="mui-navigate-right" data-diff="' + diff_count + '" data-key="' + item.id + '"data-data="' + item.policenum + '">';
									html += '<div style="width:45px;height:70px;"class="mui-pull-left" >';
									//
									html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
									html += '</div>';
									html += '<div class="mui-media-body">' + item.realname + '<p class="mui-pull-right mui-pull-right-time">异常日期：' + item.time + '</p>';
									html += '<p class="mui-ellipsis">工作职责：' + item.workname + '</p>'
									html += '<p class="mui-ellipsis">异常原因：' + item.errortype + '</p>'

									html += '</div></a>';
									li.innerHTML = html;
									fragment.appendChild(li);
								});
								ul.appendChild(fragment);
							} else {
								showWebviewToast(data.result);
							}
							mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
						},
						error: function(xhr, type, errorThrown) {
							mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
							showWebviewToast("网络异常!" + "xhr>>" + xhr + "type>>" + type + "errorThrown>>" + errorThrown);
						}
					});
				}

				//我的审批（手）下拉刷新
				function qjPullDownRefresh() {
					qjpage = 1;
					mui.ajax(basePath + '/osapi/policeHelper.php', {
						data: {
							action: 'getAuditNoApply',
							blamepolicenum: policenum,
							type: 1
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							if(data.code == "200") {
								var list = data.result;
								var length = list.length;
								var ul = document.getElementById('kaoqin2');
								var fragment = document.createDocumentFragment();
								ul.innerHTML = "";
								mui.each(list, function(index, item) {

									var apply_date = new Date(item.time);
									var diff_count = current.diff(apply_date);
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-media";
									var html = "";
									html += '<a class="mui-navigate-right" data-diff="' + diff_count + '" data-key="' + item.id + '"data-data="' + item.policenum + '">';
									html += '<div style="width:45px;height:70px;"class="mui-pull-left" >';
									//
									html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
									html += '</div>';
									html += '<div class="mui-media-body">' + item.realname + '<p class="mui-pull-right mui-pull-right-time">异常日期：' + item.time + '</p>';
									html += '<p class="mui-ellipsis">工作职责：' + item.workname + '</p>'
									html += '<p class="mui-ellipsis">异常原因：' + item.errortype + '</p>'

									html += '</div></a>';
									li.innerHTML = html;
									fragment.appendChild(li);
								});
								ul.appendChild(fragment);
							} else {
								showWebviewToast(data.result);
							}
							mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
						},
						error: function(xhr, type, errorThrown) {
							mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
							showWebviewToast("网络异常!" + "xhr>>" + xhr + "type>>" + type + "errorThrown>>" + errorThrown);
						}
					});
				}

				

				//工作日志异常下拉刷新
				function jbPullDownRefresh() {

					mui.ajax(basePath + '/osapi/policeHelper.php', {
						data: {
							action: 'getNeedsWorkLogAuditList',
							policenum: policenum
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							console.info(policenum + "...." + JSON.stringify(data));
							if(data.code == "200") {
								var list = data.result;
								var length = list.length;
								var ul = document.getElementById('jiaban');
								var fragment = document.createDocumentFragment();
								ul.innerHTML = "";
								mui.each(list, function(index, item) {
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-media";
									var html = "";
									html += '<a class="mui-navigate-right"  data-key="' + item.id + '"data-data="' + item.policenum + '"data-realname="' + item.realname + '"data-error="' + item.error + '"data-date="' + item.date + '"data-error="' + item.error + '"data-applytime="' + item.applytime + '"data-content="' + item.content + '">';
									html += '<div style="width:45px;height:70px;"class="mui-pull-left" >';
									//
									html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/>';
									html += '</div>';
									html += '<div class="mui-media-body">' + item.realname + '<p class="mui-pull-right mui-pull-right-time">异常日期：' + item.date + '</p>';
									html += '<p class="mui-ellipsis">异常原因：' + item.error + '</p>'
									html += '<p class="mui-ellipsis">申请时间：' + item.applytime + '</p>'
									html += '<p class="mui-ellipsis">申请原因：' + item.content + '</p>'

									html += '</div></a>';
									li.innerHTML = html;
									fragment.appendChild(li);

								});
								ul.appendChild(fragment);
							} else {
								var ul = document.getElementById('jiaban');
								ul.innerHTML = "";
								console.info(policenum + "...." + JSON.stringify(data));
								showWebviewToast(data.result);
							}
							mui('#item3mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
						},
						error: function(xhr, type, errorThrown) {

							mui('#item3mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
							showWebviewToast("网络异常!");
						}
					});
				}

				mui.ready(function() {
					mui('#item1mobile').pullRefresh().pulldownLoading();
					mui('#item2mobile').pullRefresh().pulldownLoading();
					mui('#item3mobile').pullRefresh().pulldownLoading();
				});

				mui("#item1mobile").on("tap", "a", function() {
					var id = this.getAttribute('data-key');
					var policenum = this.getAttribute('data-data');
					var diff_count = this.getAttribute('data-diff');
					document.location.href = "list/detail.php?id=" + id + '&policenum=' + policenum + '&diff=' + diff_count;
				});

				mui("#item2mobile").on("tap", "a", function() {
					var id = this.getAttribute('data-key');
					var policenum = this.getAttribute('data-data');
					var diff_count = this.getAttribute('data-diff');
					document.location.href = "list/detail.php?id=" + id + '&policenum=' + policenum + '&diff=' + diff_count;
				});

				mui("#item3mobile").on("tap", "a", function() {
					var id = this.getAttribute('data-key');
					var policenum_data = this.getAttribute('data-data');
					var realname = this.getAttribute('data-realname');
					var error = this.getAttribute('data-error');
					var date = this.getAttribute('data-date');
					var applytime = this.getAttribute('data-applytime');
					var content = this.getAttribute('data-content');
					window.javaInterface.startDefaultHtmlActivity(basePath + '/extapp/app/html5/attendance/fujing/recordDetail.php?id=' + id + '&policenum=' + policenum_data + '&date=' + date + '&realname=' + realname + '&error=' + error + '&applytime=' + applytime + '&content=' + content);
				});

				setTitle('我的审批列表'); //设置title

			})(mui);
		</script>
	</body>

</html>
