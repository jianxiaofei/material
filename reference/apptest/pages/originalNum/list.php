<!--
作者：836110252@qq.com
时间：2016-05-29
描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>原号列表</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" href="../../css/iconfont.css" />
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

	<body class="mui-slider mui-fullscreen">
		<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>

		<div class="mui-content mui-fullscreen">
			<div id="item1mobile" class="mui-content mui-scroll-wrapper mui-fullscreen">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron" id="yhlist">

					</ul>
				</div>
			</div>
		</div>

		<script src="../../js/mui.min.js "></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init();
			//获取警员编号
			var policenum = getPolicenum();
			//获取登录token
			var token = getToken();
			//初始化单页的区域滚动
			mui('.mui-scroll-wrapper').scroll();
			var page = 0;
			var perpage = 10;

			(function($) {

				mui('#item1mobile').pullRefresh({
					up: {
						contentrefresh: "正在加载...",
						callback: kqPullUpRefresh
					},
					down: {
						contentrefresh: "正在刷新...",
						callback: kqPullDownRefresh
					}
				});

				//我的考勤下拉刷新
				function kqPullDownRefresh() {
					page = 1;
					perpage = 10;
					console.info("-----"+policenum);
					mui.ajax(basePath + '/osapi/firstCode.php', {
						data: {
							action: 'getApplyList',
							policenum: policenum,
							serialnumber: '',
							carnumber: '',
							page: page,
							perpage: perpage,
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							if(data.code == "200") {
								console.info(">>>>"+data.result);
								var list = data.result.result;
								var length = list.length;
								var ul = document.getElementById('yhlist');
								var fragment = document.createDocumentFragment();
								ul.innerHTML = "";
								mui.each(list, function(index, item) {
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-media";
									var html = "";
									html += '<a class="mui-navigate-right" data-key="' + item.id + '">';
									if(item.status == "审批通过") {
										html += '<span class="datatom-pass mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									} else if(item.status == "申请") {
										html += '<span class="datatom-wait mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									} else if(item.status == "审批不通过") {
										html += '<span class="datatom-nopass mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									}

									html += '<div class="mui-media-body">' + item.content;
									if(item.status == "审批通过") {
										html += '<p class="mui-ellipsis">审批完成（通过）</p>';
									} else if(item.status == "申请") {
										html += '<p class="mui-ellipsis">等待审批</p>';
									} else {
										html += '<p class="mui-ellipsis">审批完成（未通过）</p>';
									}
									html += '<p class="mui-ellipsis">申请人：' + item.applyname + '</p>'
									html += '</div></a>';
									li.innerHTML = html;
									fragment.appendChild(li);
								});
								ul.appendChild(fragment);
							} else {
								console.info(">>>>"+data.result);
								showWebviewToast("没有数据");
							}
							mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
						},
						error: function(xhr, type, errorThrown) {
							console.info("加载失败");
							mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
							showWebviewToast("网络异常!");
						}
					});
				}
				//上拉加载更多
				function kqPullUpRefresh() {
					page ++;
					mui.ajax(basePath + '/osapi/firstCode.php', {
						data: {
							action: 'getApplyList',
							policenum: policenum,
							page: page,
							perpage: perpage,
							serialnumber: '',
							carnumber: '',
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							if(data.code == "200") {
								console.info("上拉加载获取成功");
								var list = data.result.result;
								var length = list.length;
								var ul = document.getElementById('yhlist');
								var fragment = document.createDocumentFragment();
								mui.each(list, function(index, item) {
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-media";
									var html = "";
									html += '<a class="mui-navigate-right" data-key="' + item.id + '">';
									if(item.status == "审批通过") {
										html += '<span class="datatom-pass mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									} else if(item.status == "申请") {
										html += '<span class="datatom-wait mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									} else if(item.status == "审批不通过") {
										html += '<span class="datatom-nopass mui-media-object mui-pull-left mui-icon iconfont datatom-icon-shenqing"></span>';
									}

									html += '<div class="mui-media-body">' + item.content;
									if(item.status == "审批通过") {
										html += '<p class="mui-ellipsis">审批完成（通过）</p>';
									} else if(item.status == "申请") {
										html += '<p class="mui-ellipsis">等待审批</p>';
									} else {
										html += '<p class="mui-ellipsis">审批完成（未通过）</p>';
									}
									html += '<p class="mui-ellipsis">申请人：' + item.applyname + '</p>'
									html += '</div></a>';
									li.innerHTML = html;
									fragment.appendChild(li);
								});
								ul.appendChild(fragment);
							} else {

								showWebviewToast(data.msg);
							}
							mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed
						},
						error: function(xhr, type, errorThrown) {
							mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed
							showWebviewToast("网络异常!");
						}
					});
				}
				mui.ready(function() {
					mui('#item1mobile').pullRefresh().pulldownLoading();
				});
				mui("#item1mobile").on("tap", "a", function() {
					var id = this.getAttribute('data-key');
					document.location.href = "detail.php?id=" + id;
				});
			})(mui);
		</script>
	</body>

</html>