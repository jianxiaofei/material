<!--
	作者：836110252@qq.com
	时间：2016-05-29
	业务描述：1、根据部门id查询通知公告列表信息,附带参数token,均从app获取
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>设施上报</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			.mui-media-body {
				font-size: .9rem;
				color: #3b3d3d;
			}
			
			.mui-media-body .mui-ellipsis {
				font-size: .7rem;
			}
			
			.mui-media-object {
				border-radius: 50%;
			}
			
			.mui-table-view:before,
			.mui-table-view:after {
				background-color: #fff;
			}
			
			.mui-content {
				background-color: #fff;
			}
			
			.submit-btn {
				position: absolute;
				color: #FFF;
				background-color: #CCCC00;
				width: 80px;
				right: 10px;
				height: 80px;
				padding: 20px;
				-webkit-border-radius: 60px;
				-moz-border-radius: 60px;
				border-radius: 60px;
				box-shadow: 3px 3px 3px #666;
				bottom: 10px;
			}
			
			.add_tzgg {
				width: 55px!important;
				height: 55px!important;
				border-radius: 50%;
				position: fixed;
				right: 2%;
				bottom: 1%;
				z-index: 100;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-fullscreen">
			<div id="pullrefresh" class="mui-content mui-scroll-wrapper mui-fullscreen">
				<div class="mui-scroll">
					<!--数据列表-->
					<ul class="mui-table-view mui-table-view-chevron">

					</ul>
				</div>
			</div>
			<div class="mui-block" style="position: absolute;width: 100%;bottom: 0px;text-align: center;">
				<button id="addFacility" type="button" class="mui-btn mui-btn-primary add_tzgg" style="width: 90%;height: 46px;">+</button>
			</div>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init({
				gestureConfig: {
					longtap: true
				}
			});
			var token = getToken();
			var policenum = getPolicenum();
			var perpage = 10;
			var currentPage=1;//当前页
			var totalPage=0;//请求数据的总页数
			
			
			mui('#pullrefresh').pullRefresh({
				up: {
					contentrefresh: "正在加载...",
					callback: noticePullUpRefresh
				},
				down: {
					contentrefresh: "正在加载...",
					callback: noticePullDownRefresh
				}
			});

			/**
			 * 通知公告下拉刷新具体业务实现
			 */
			function noticePullDownRefresh() {
				mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
					data: {
						action: 'getTaskOfApp',
						policenum : policenum,
						page : currentPage,
						perpage: perpage,
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
//原代码-------------------------------------------------------		
					if(data.code == "200") {
						if(data.count<=10)
						{
							totalPage=1;
						}else{
							totalPage=data.count/2;
						}
						currentPage=1;
							var list = data.result;
							var length = list.length;
							var table = document.body.querySelector('#pullrefresh .mui-table-view');
							table.innerHTML = "";
							var fragment = document.createDocumentFragment();
							for(var i = 0; i < length; i++) {
								var notice = list[i];
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell mui-media';
								var html = '<a class="mui-navigate-right" data="' + notice.id + '">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="' + basePath + '/osapi/avantar.php?policenum=' + notice.recordpeoplenum + '"/>';
								html += '<div class="mui-media-body">' + notice.remarks;
								html += '<p class="mui-ellipsis">' + notice.recordpeople;
								html += '<span class="mui-pull-right">' + notice.createtime + '</span></p></div></a>';
								li.innerHTML = html;
								fragment.appendChild(li);
								if(i == length - 1) {
									createtime = notice.createtime;
								}
							}
							table.appendChild(fragment);
						
						} else {
							showWebviewToast(data.msg);
						}
						
//原代码--------------------------------------------	
						mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
					},
					error: function(xhr, type, errorThrown) {
						mui.toast("网络异常")
						mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
					}
				});
			}
			/**
			 * 通知公告上拉加载具体业务实现
			 */
			function noticePullUpRefresh() {
				if(currentPage==totalPage)
				{
					mui.toast("全部数据已加载完成");
					mui('#pullrefresh').pullRefresh().endPullupToRefresh();
					return;
				}
				mui.ajax(basePath + '/osapi/task_distribution_new_app.php', {
					data: {
						action: 'getTaskOfApp',
						policenum : policenum,
						page : currentPage,
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
							var list = data.result;
							var length = list.length;
							var table = document.body.querySelector('#pullrefresh .mui-table-view');
							var fragment = document.createDocumentFragment();
							for(var i = 0; i < length; i++) {
								var notice = list[i];
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell mui-media';
								var html = '<a class="mui-navigate-right" data="' + notice.id + '">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="' + basePath + '/osapi/avantar.php?policenum=' + notice.recordpeoplenum + '"/>';
								html += '<div class="mui-media-body">' + notice.remarks;
								html += '<p class="mui-ellipsis">' + notice.recordpeople;
								html += '<span class="mui-pull-right">' + notice.createtime + '</span></p></div></a>';
								li.innerHTML = html;
								fragment.appendChild(li);
								if(i == length - 1) {
									createtime = notice.createtime;
								}
							}
							table.appendChild(fragment);
						} else {
							mui.toast(data.msg);
						}
						mui('#pullrefresh').pullRefresh().endPullupToRefresh(); //refresh completed
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});
			}

			mui.ready(function() {
				mui('#pullrefresh').pullRefresh().pulldownLoading();
			});

			mui("#pullrefresh .mui-table-view").on("tap", "a.mui-navigate-right", function() {
				//获取id
				var id = this.getAttribute("data");
				document.location.href = "../commandcenter/detail.php?id=" + id;
//				document.location.href = "facility_details.php?id=" + id;
			});
//长按删除
//			mui("#pullrefresh .mui-table-view").on("longtap", "a.mui-navigate-right", function() {
//				//获取id
//				var id = this.getAttribute("data");
//				var policenum = getPolicenum();
//				var btnArray = ['否', '是'];
//				mui.confirm('删除此条通知公告，确认？', '通知公告', btnArray, function(e) {
//					if(e.index == 1) {
//						mui.ajax(basePath + '/osapi/police_notice.php', {
//							data: {
//								action: 'deleteNotice',
//								id: id,
//								operator: policenum
//							},
//							beforeSend: function(request) {
//								request.setRequestHeader("U-Auth-Token", token);
//							},
//							dataType: 'json', //服务器返回json格式数据
//							type: 'POST', //HTTP请求类型
//							timeout: 10000, //超时时间设置为10秒；
//							success: function(data) {
//								if(data.code == "200") {
//									window.location.reload();
//									showWebviewToast("删除成功!");
//								} else {
//									showWebviewToast(data.result);
//								}
//							},
//							error: function(xhr, type, errorThrown) {
//								showWebviewToast("网络异常");
//							}
//						});
//					} else {
//						return;
//					}
//				});
//
//			});
//长按删除
			document.getElementById('addFacility').addEventListener('tap',function() {
				console.log(111);
				window.location.href = "facility_add.php";
			});

			setTitle("设施上报");
		</script>
	</body>

</html>