<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>任务列表</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>body {
	font-family: 'none';
}

.item {
	 margin: 10px 0 20px 0;
	background: #fff;
	padding-top: 10px;
	overflow: hidden;
	border-bottom: solid 1px #e3e3e3;
	border-top: solid 1px #e3e3e3
}

.item .context {
	font-size: 14px;
	color: #222;
	padding: 1.8%;
	overflow: hidden
}

.item .context:active {
	background: #eee
}

.item .pic img {
	float: left;
	width: 30%;
	margin: 10px 1.5%
}

.item .head {
	clear: both;
	overflow: hidden;
	font-size: 14px;
	color: #000
}

.item .head .usertop {
	margin-top: 3px
}

.item .head .username {
	color: #000
}

.item .head .mui-pull-right {
	padding-right: 10px;
	color: #ccc;
	font-size: 12px
}

.item .head .avatar {
	border-radius: 50%;
	width: 30px;
	height: 30px;
	float: left;
	margin: 0 10px 10px 10px
}

.item .foot {
	clear: both;
	padding: 5px;
	color: #ccc;
	text-align: right
}

.mui-slider {
	background: #fff
}

.body-header {
	padding: 6px 0 7px 5px;
	/*border: 1px solid #888;*/
	background: #efeff4;
	font-size: 14px;
	color: #222;
	height: 34px;
	margin: 0 auto;
}

.mui-table-view {
	background: #efeff4;
	background-color: #efeff4;
}

.body-header-item {
	float: left
}

.body-header-item.selected {
	color: red
}

.body-header .line {
	color: #ccc;
	margin: -2px 10px;
	float: left
}

.page-btn {
	text-align: center;
	padding-top: 10px;
	padding-bottom: 20px
}

#refresh {
	position: fixed;
	bottom: 10%;
	font-size: 40px;
	margin-left: 80%;
	color: orange;
	padding: 10px
}

#refresh:active {
	color: #666
}

h5 {
	padding-top: 10px
}

.list .mui-table-view-cell.mui-media .mui-media-object {
	height: 75px;
	width: 75px;
	max-width: 75px;
	min-width: 75px;
	max-height: 75px;
	min-height: 75px;
	border-radius: 50%;
}

.list .mui-table-view-cell b {
	font-size: .5rem;
	color: #888;
}

.card {
	position: relative;
	font-size: .7rem;
	background: #fff;
	border-radius: .1rem;
	box-shadow: 0 .05rem .1rem rgba(0, 0, 0, .3);
}

.card-header,
.card-footer {
	position: relative;
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	min-height: 2.2rem;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: .5rem .75rem;
	-webkit-box-pack: justify;
	-ms-flex-pack: justify;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
}

.card-header {
	font-size: .85rem;
	border-bottom: 1px solid #e1e1e1;
	border-radius: .1rem .1rem 0 0;
}

.card-content {
	position: relative;
}

.card-content-inner {
	position: relative;
	padding: .75rem;
}

.card-footer {
	color: #5f646e;
	border-top: 1px solid #e1e1e1;
	border-radius: 0 0 .1rem .1rem;
}

.card-header a.link,
.card-footer a.link,
.card-footer p {
	position: relative;
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	height: 2.2rem;
	margin-top: -.5rem;
	margin-bottom: -.5rem;
	line-height: 2.2rem;
	s text-decoration: none;
	-webkit-transition-duration: 300ms;
	-o-transition-duration: 300ms;
	transition-duration: 300ms;
	-webkit-box-pack: start;
	-ms-flex-pack: start;
	-webkit-justify-content: flex-start;
	justify-content: flex-start;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
}

.card-content-inner {
	display: flex;
}

.mui-table-view-cell:after {
	height: 0;
}

html,
body,
.mui-content {
	background-color: #efeff4;
}

.mui-table-view:before,
.mui-table-view:after {
	height: 0;
}

.status-circle {
	width: 3rem;
	height: 3rem;
	border-radius: 50%;
	color: #FFF;
	background-color: purple;
	line-height: 3rem;
	font-size: .5rem;
	text-align: center;
}

.mui-ellipsis img,
.info img,
.link img {
	width: 16px;
	margin-right: 3%;
}

.mui-ellipsis img,
.info img {
	position: relative;
	top: 3px;
}

.mui-media-body {
	margin-left: 5%;
}

.card-content {
	font-size: 10px;
}

.mui-media-object {
	margin-top: 1.5%;
}

#main-total {
	margin-top: -2%;
	margin-right: 4%;
	float: left;
}

.mui-badge {
	color: #FFF;
}

.mui-media-body {
	width: 90%;
}

.list .mui-active {
	background-color: #FFF;
	!important
}</style>
	</head>

	<body>
		<div class="mui-content mui-fullscreen">
			<div class="public-header" style="margin-top: 10px;">
				<div class="mui-row">

					<div class="mui-col-sm-2 mui-col-xs-2"></div>

					<div class="body-header mui-col-sm-9 mui-col-xs-9" >
						<span class="body-header-item selected"  data-key="createtime" data-data="desc">创建时间↓</span>
						<span class="line">|</span>
						<span class="body-header-item" data-key="starttime" data-data="desc">开始时间↓</span>
						<span class="line">|</span>
						<span class="body-header-item" data-key="endtime" data-data="desc">截止时间↓</span>
					</div>
					<div class="mui-col-sm-1 mui-col-xs-1"></div>
				</div>
				<div id="pullrefresh" class="mui-content mui-fullscreen mui-scroll-wrapper" style="margin-top: 37px;">
					<div class="mui-scroll">
						<ul class="mui-table-view list" id="list">

						</ul>
					</div>
				</div>
			</div>
			<script src="../../js/mui.min.js"></script>
			<script src="../../js/common.js" charset="UTF-8"></script>
			<script>mui.init({
	swipeBack: false
});

/**
 * 本页面比较复杂 发出任务 收到任务 任务监控使用同一页面
 */
var policenum = getPolicenum();
var token = getToken();
var page = 1;
var size = 10;
var pageType =<?php echo "'". $_GET["pageType"] . "'" ?>;
var sortType = "createtime";
var sortValue = "desc";

(function($) {
	mui('.body-header').on('click', 'span.body-header-item', function() {
		if(this.classList.contains('selected')) {
			var parent = this.parentNode; //获取当前元素的父节点
			var children = parent.children;
			mui.each(children, function(index, item) {
				item.classList.remove('selected');
			});
			this.classList.add('selected');
			sortType = this.getAttribute('data-key');
			if("desc" == this.getAttribute('data-data')) {
				if("createtime" == sortType) {
					this.innerHTML = "创建时间↑";
				} else if("starttime" == sortType) {
					this.innerHTML = "开始时间↑";
				} else {
					this.innerHTML = "截止时间↑";
				}
				this.setAttribute("data-data", "asc");
				sortValue = "asc";
			} else {
				this.setAttribute("data-data", "desc");
				if("createtime" == sortType) {
					this.innerHTML = "创建时间↓";
				} else if("starttime" == sortType) {
					this.innerHTML = "开始时间↓";
				} else {
					this.innerHTML = "截止时间↓";
				}
				sortValue = "desc";
			}
			mui('#pullrefresh').pullRefresh().pulldownLoading();
		} else {
			var parent = this.parentNode; //获取当前元素的父节点
			var children = parent.children;
			mui.each(children, function(index, item) {
				item.classList.remove('selected');
			});
			this.classList.add('selected');
			sortValue = "desc";
			sortType = this.getAttribute('data-key');
			if("createtime" == sortType) {
				this.innerHTML = "创建时间↓";
			} else if("starttime" == sortType) {
				this.innerHTML = "开始时间↓";
			} else {
				this.innerHTML = "截止时间↓";
			}
			mui('#pullrefresh').pullRefresh().pulldownLoading();
		}

	});

	//上加载更多  下拉刷新
	mui('#pullrefresh').pullRefresh({
		up: {
			contentrefresh: "正在加载...",
			callback: pullUpRefresh
		},
		down: {
			contentrefresh: "正在加载...",
			callback: pullDownRefresh
		}
	});

	/**
	 * 下拉刷新具体业务实现
	 */
	function pullDownRefresh() {
		page = 1;
		mui.ajax(basePath + "/osapi/task.php", {
			data: {
				"action": "getTaskLists",
				"policenum": policenum,
				"type": pageType,
				"page": page,
				"size": size,
				"sortType": sortType,
				"sortValue": sortValue
			},
			beforeSend: function(request) {
				request.setRequestHeader("U-Auth-Token", token);
			},
			dataType: 'json', //服务器返回json格式数据
			type: 'POST', //HTTP请求类型
			timeout: 10000, //超时时间设置为10秒；
			success: function(data) {
				if("200" == data.code) {
					var list = data.result;
					var ul = document.body.querySelector('.mui-table-view');
					ul.innerHTML = null;
					mui.each(list, function(index, item) {

						//判断任务状态给不同颜色标识
						var taskstatusColor = "#f36861";
						if("超期" == item.taskStatusString) {
							taskstatusColor = "#f36861";
						} else if("取消" == item.taskStatusString) {
							taskstatusColor = "#834401";
						} else if("执行中" == item.taskStatusString) {
							taskstatusColor = "#a0a0a0";
						} else if("超时完成" == item.taskStatusString) {
							taskstatusColor = "#ff6b50";
						} else if("完成" == item.taskStatusString) {
							taskstatusColor = "#22ac37";
						} else if("完成" == item.taskStatusString) {
							taskstatusColor = "#22ac37";
						}

						//默认普通
						var tasklevelColor = "#888";
						if(item.tasklevel == 1) {
							//如果为1则是重要
							tasklevelColor = "#e23e65";
						} else if(2 == item.tasklevel) {
							//如果为2则是紧急
							tasklevelColor = "#da3ec6";
						}
						//默认工作布置
						var tasktypeColor = "#ef5682";
						if("1" == item.tasktype) {
							//接警处
							tasktypeColor = "#875ca4";
						} else if("2" == item.tasktype) {
							//工作布置
							tasktypeColor = "#ef5682";
						} else if("4" == item.tasktype) {
							//请示汇报
							tasktypeColor = "#636dea";
						} else if("0" == item.tasktype) {
							//公文
							tasktypeColor = "#53ec9f";
						} else if("5" == item.tasktype) {
							//公文
							tasktypeColor = "#13b5b1";
						} else if("-1" == item.tasktype) {
							//系统
							tasktypeColor = "#b16425";
						}
						var createtime = "";
						var starttime = "";
						var endtime = "";
						if("createtime" == sortType) {
							createtime = '<font color="red">' + item.createtime + '</font>';
						} else {
							createtime = item.createtime;
						}
						if("starttime" == sortType) {
							starttime = '<font color="red">' + item.starttime + '</font>';
						} else {
							starttime = item.starttime;
						}
						if("endtime" == sortType) {
							endtime = '<font color="red">' + item.endtime + '</font>';
						} else {
							endtime = item.endtime;
						}
						var taskTypeStr = "";
						if(undefined == item.taskTypeStr || null == item.taskTypeStr || "" == item.taskTypeStr) {
							taskTypeStr = "系统处理";
						} else {
							taskTypeStr = item.taskTypeStr;
						}
						var link_detail = "";
						if(item.taskstatus != 2) {
							var read = false;
							mui.each(item.readedList, function(index, item) {
								if(item == policenum) {
									read = true;
								}
							});
							link_detail = '<a class="link link-detail" data-data="' + read + '" data-key="' + item.taskid + '">查看详情</a>';
						}
						var taskname = item.taskname.length > 14 ? item.taskname.substring(0, 14) + '...' : item.taskname;
						var li = document.createElement('li');
						li.className = 'mui-table-view-cell mui-media';
						li.innerHTML = '<div class="card">' +
							'<div class="card-header" style="color: #888;">' + taskname + '<span class="mui-badge mui-pull-right" style="background-color:' + taskstatusColor + '">' + item.taskStatusString + '</span></div>' +
							'<div class="card-content"><div class="card-content-inner">' +
							'<img class="mui-media-object mui-pull-left" src="' + basePath + '/osapi/avantar.php?policenum=' + item.creator + '">' +
							'<div class="mui-media-body">' +
							'<p class="mui-ellipsis">' + item.viewName + '</p>' +
							'<p class="mui-ellipsis"><span class="mui-badge" style="background:' + tasklevelColor + '">' + item.taskLevelString + '</span><span style="margin-left:5px;background-color:' + tasktypeColor + '" class="mui-badge mui-badge-success">' + taskTypeStr + '</span></p>' +
							'<p class="mui-ellipsis" style="font-size: 10px;"><img src="../../img/starttime.png"/>' + starttime + '</span></p>' +
							'<p class="info" style="font-size: 10px;"><img src="../../img/overtime.png"/>' + endtime + '</span>' +
							'</p></div></div></div>' +
							'<div class="card-footer" style="text-align: right;">' +
							'<p  class="link" id="main-total" style="width:50%;font-size:12px;text-align:left;color:#888;">' + createtime + '</p>' +
							link_detail +
							'</div></div>';
						ul.appendChild(li);
					});
					mui('#pullrefresh').pullRefresh().endPulldownToRefresh();
				} else {
					mui('#pullrefresh').pullRefresh().endPulldownToRefresh();
					window.javaInterface.showWebviewToast(data.msg);
				}
			},
			error: function(xhr, type, errorThrown) {
				mui.alert('请求失败！请检查网络是否异常!', '警告信息');
			}
		});
	}

	/**
	 * 上拉加载具体业务实现
	 */
	function pullUpRefresh() {
		page++;
		mui.ajax(basePath + '/osapi/task.php', {
			data: {
				"action": "getTaskLists",
				"policenum": policenum,
				"type": pageType,
				"page": page,
				"size": size,
				"sortType": sortType,
				"sortValue": sortValue
			},
			beforeSend: function(request) {
				request.setRequestHeader("U-Auth-Token", token);
			},
			dataType: 'json', //服务器返回json格式数据
			type: 'POST', //HTTP请求类型
			timeout: 10000, //超时时间设置为10秒；
			success: function(data) {
				var list = data.result;
				var ul = document.body.querySelector('.mui-table-view');
				mui.each(list, function(index, item) {

					//判断任务状态给不同颜色标识
					var taskstatusColor = "#f36861";
					if("超期" == item.taskStatusString) {
						taskstatusColor = "#f36861";
					} else if("取消" == item.taskStatusString) {
						taskstatusColor = "#834401";
					} else if("执行中" == item.taskStatusString) {
						taskstatusColor = "#a0a0a0";
					} else if("超时完成" == item.taskStatusString) {
						taskstatusColor = "#ff6b50";
					} else if("完成" == item.taskStatusString) {
						taskstatusColor = "#22ac37";
					} else if("完成" == item.taskStatusString) {
						taskstatusColor = "#22ac37";
					}

					//默认普通
					var tasklevelColor = "#888";
					if(item.tasklevel == 1) {
						//如果为1则是重要
						tasklevelColor = "#e23e65";
					} else if(2 == item.tasklevel) {
						//如果为2则是紧急
						tasklevelColor = "#da3ec6";
					}
					//默认工作布置
					var tasktypeColor = "#ef5682";
					if("1" == item.tasktype) {
						//接警处
						tasktypeColor = "#875ca4";
					} else if("2" == item.tasktype) {
						//工作布置
						tasktypeColor = "#ef5682";
					} else if("4" == item.tasktype) {
						//请示汇报
						tasktypeColor = "#636dea";
					} else if("0" == item.tasktype) {
						//公文
						tasktypeColor = "#53ec9f";
					} else if("5" == item.tasktype) {
						//公文
						tasktypeColor = "#13b5b1";
					} else if("-1" == item.tasktype) {
						//系统
						tasktypeColor = "#b16425";
					}
					var createtime = "";
					var starttime = "";
					var endtime = "";
					if("createtime" == sortType) {
						createtime = '<font color="red">' + item.createtime + '</font>';
					} else {
						createtime = item.createtime;
					}
					if("starttime" == sortType) {
						starttime = '<font color="red">' + item.starttime + '</font>';
					} else {
						starttime = item.starttime;
					}
					if("endtime" == sortType) {
						endtime = '<font color="red">' + item.endtime + '</font>';
					} else {
						endtime = item.endtime;
					}
					var taskTypeStr = "";
					if(undefined == item.taskTypeStr || null == item.taskTypeStr || "" == item.taskTypeStr) {
						taskTypeStr = "系统处理";
					} else {
						taskTypeStr = item.taskTypeStr;
					}

					var link_detail = "";
					if(item.taskstatus != 2) {
						var read = false;
						mui.each(item.readedList, function(index, item) {
							if(item == policenum) {
								read = true;
							}
						});
						link_detail = '<a class="link link-detail" data-task="' + '" data-data="' + read + '" data-key="' + item.taskid + '">查看详情</a>';
					}
					var taskname = item.taskname.length > 14 ? item.taskname.substring(0, 14) + '...' : item.taskname;
					var li = document.createElement('li');
					li.className = 'mui-table-view-cell mui-media';
					li.innerHTML = '<div class="card">' +
						'<div class="card-header" style="color: #888;">' + taskname + '<span class="mui-badge mui-pull-right" style="background-color:' + taskstatusColor + '">' + item.taskStatusString + '</span></div>' +
						'<div class="card-content"><div class="card-content-inner">' +
						'<img class="mui-media-object mui-pull-left" src="' + basePath + '/osapi/avantar.php?policenum=' + item.creator + '">' +
						'<div class="mui-media-body">' +
						'<p class="mui-ellipsis">' + item.viewName + '</p>' +
						'<p class="mui-ellipsis"><span class="mui-badge" style="background:' + tasklevelColor + '">' + item.taskLevelString + '</span><span style="margin-left:5px;background-color:' + tasktypeColor + '" class="mui-badge mui-badge-success">' + taskTypeStr + '</span></p>' +
						'<p class="mui-ellipsis" style="font-size: 10px;"><img src="../../img/starttime.png"/>' + starttime + '</span></p>' +
						'<p class="info" style="font-size: 10px;"><img src="../../img/overtime.png"/>' + endtime + '</span>' +
						'</p></div></div></div>' +
						'<div class="card-footer" style="text-align: right;">' +
						'<a href="javascript:;" class="link" id="main-total" style="width:50%;margin-top: 10px;text-align:left;color:#888;"><img src="../../img/createtime.png"/>' + createtime + '</a>' +
						link_detail +
						'/div></div>';
					ul.appendChild(li);
				});
				mui('#pullrefresh').pullRefresh().endPullupToRefresh();
			},
			error: function(xhr, type, errorThrown) {
				mui.alert('请求失败！请检查网络是否异常!', '警告信息');
			}
		});
	}

	mui("#list").on("tap", "a", function() {
		//window.javaInterface.showWebviewToast('模块维护中,请稍后再试!');
		var id = this.getAttribute('data-key');
		var read = this.getAttribute('data-data');
		//打开详情时即为签收此任务
		if("accept" == pageType && "false" == read) {
			var body = {};
			body.comment = "签收";
			var logtime = getNowFormatDate() + " " + getHHMMSS();
			body.logtime = logtime.substring(0, 16);
			body.operateType = "1";
			body.taskid = id;
			body.policenum = policenum;
			mui.ajax(basePath + '/apps/task/reply/send', {
				data: JSON.stringify(body),
				beforeSend: function(request) {
					request.setRequestHeader("Content-Type", "application/json");
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType: 'json', //服务器返回json格式数据
				type: 'POST', //HTTP请求类型
				timeout: 10000, //超时时间设置为10秒；
				success: function(data) {
					showWebviewToast("签收成功!");
				}
			});
			//目前调了两次请求
			//此处这样调用这个方法有点问题，应该只调一次请求  但是后端要处理任务记录以及增加任务处理日志记录
			/*var task = {};
			task.taskid = id;
			mui.ajax(basePath+'/apps/task/update',{
			data:JSON.stringify(task),
			beforeSend: function(request) {
			request.setRequestHeader("Content-Type", "application/json");
			},
			dataType:'json',//服务器返回json格式数据
			type:'POST',//HTTP请求类型
			timeout:10000,//超时时间设置为10秒；
			success:function(data){
			window.location.reload();
			},
			error:function(xhr,type,errorThrown){
			showWebviewToast("网络异常");
			}
			});*/
		}
		document.location.href = "taskdetail.php?id=" + id + "&pageType=" + pageType;
	});

	mui.ready(function() {
		mui('#pullrefresh').pullRefresh().pulldownLoading();
	});
	if("send" == pageType) {
		window.javaInterface.setTitle('发出的任务'); //设置title
	} else if("accept" == pageType) {
		window.javaInterface.setTitle('收到的任务'); //设置title
	} else {
		window.javaInterface.setTitle('任务监控'); //设置title
	}

})(mui);</script>
	</body>

</html>