<!--
	作者：836110252@qq.com
	时间：2016-05-29
	业务描述：1、此模块包含一般消息和任务消息
		   2、点击列表查看详情时需要调用修改记录为已读的接口
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>消息中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	<style>
		html,body,
		.mui-content {
			color:#888;
			background-color: #FFF;
		}
		
		.times{
			font-size: .7rem;
		}
		.mui-media-body .title{
			font-weight: bold;
			font-size: .8rem;
		}
		.mui-media-body .mui-ellipsis{
			text-indent: 20px;
			font-size: .8rem;
			white-space: normal;
		}
		.mui-media-object{
			border-radius: 50%;
		}
		.mui-table-view-cell:after{
			left: 65px;
		}
		.item1mobile .mui-badge{
			font-size: 10px;
		    line-height: 1.4;
		    position: absolute;
		    top: 0px;
		    left: 32%;
		    margin-left: -10px;
		    padding: 1px 5px;
		    color: #fff;
		    background: red;
		}
		.item2mobile .mui-badge{
			font-size: 10px;
		    line-height: 1.4;
		    position: absolute;
		    top: 0px;
		    left: 82%;
		    margin-left: -10px;
		    padding: 1px 5px;
		    color: #fff;
		    background: red;
		}
		#sliderSegmentedControl{
			
		}
		.mui-table-view .mui-badge-unread{
			width: 10px;
			height: 10px;
			font-size: 10px;
		    line-height: 1.4;
		    position: absolute;
		    top: 10px;
		    left: 55px;
		    margin-left: -10px;
		    padding: 1px 5px;
		    color: #fff;
		    background: red;
		    border-radius: 10px;		    
		}

		.mui-slider .mui-segmented-control.mui-segmented-control-inverted~.mui-slider-group .mui-slider-item {
			border:none;
		}
	</style>
</head>
<body>
<div class="mui-content">
	<div id="slider" class="mui-slider mui-fullscreen">
		<div id="sliderSegmentedControl"
			style="margin-top: 5px;"
			 class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
			<a class="mui-control-item item1mobile" id="xiaoxi" href="#item1mobile">
				消息<span class="mui-badge" id="snum">0</span>
			</a>
			<!--<span>|</span>-->
			<a class="mui-control-item item2mobile" id="tesks" href="#item2mobile">
				任务<span class="mui-badge" id="tasknum"></span>
			</a>
		</div>
		<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-6"></div>
		<div class="mui-slider-group">
			<div id="item1mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content mui-active">
				<div class="mui-scroll">
					<ul class="mui-table-view" id="message">
						
					</ul>
				</div>
			</div>
			<div id="item2mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content">
				<div class="mui-scroll">
					<ul class="mui-table-view" id="task">
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../../js/mui.min.js"></script>
<script src="../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init({
		swipeBack: false
	});
	(function ($) {
		var policenum = getPolicenum();
		var token = getToken();
		var npage = 0;
		var tpage = 0;
		var size = 10;
		mui('#item1mobile').pullRefresh({
			up: {
				contentrefresh: "正在加载...",
				callback: messagePullUpRefresh
			},
			down:{
				contentrefresh: "正在加载...",
				callback: messagePullDownRefresh
			}
		});
		
		mui('#item2mobile').pullRefresh({
			up: {
				contentrefresh: "正在加载...",
				callback: taskPullUpRefresh
			},
			down:{
				contentrefresh: "正在加载...",
				callback: taskPullDownRefresh
			}
		});
		
		function messagePullUpRefresh(){
			npage++;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'noticeList',
					policenum:policenum,
					offset:npage,
					size:size,
					type:"message"
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						var message = data.result.list;
						var snum = document.body.querySelector("#snum");
						snum.innerHTML = data.result.total;
						var length = message.length;
						var ul = document.body.querySelector("#message");
						var fragment = document.createDocumentFragment();
						mui.each(message,function(index,item){
							var data = item.messagebody;
							var title = data.substring(data.indexOf("【"),data.indexOf("】")+1);
							var li = document.createElement('li');
							var unread = "";
							if(item.unread){
								unread = '<span class="mui-badge-unread">&nbsp;</span>'
							}
							li.className = "mui-table-view-cell list_message";
							li.innerHTML = '<a data="'+item.id+'" key="'+item.unread+'">'
											+'<img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+policenum+'">'
											+unread
											+'<div class="mui-media-body">'
											+'<span class="title">'+title+'</span><p class="mui-ellipsis">'+data.replace(",","").replace(title,"").substr(0,29)+'...</p>'
											+'<span class="times mui-pull-right">'+item.logtime+'</span></div></a>';
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);
					}else{							
						showWebviewToast(data.msg);
					}
					mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常!");
				}
			});
		}
		
		function messagePullDownRefresh(){
			npage = 1;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'noticeList',
					policenum:policenum,
					offset:npage,
					size:size,
					type:"message"
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
//					showWebviewToast(JSON.stringify(data));
					if(data.code=="200"){
						var message = data.result.list;
						var snum = document.body.querySelector("#snum");
						snum.innerHTML = data.result.total;
						var length = message.length;
						var ul = document.body.querySelector("#message");
						var fragment = document.createDocumentFragment();
						ul.innerHTML = "";
						mui.each(message,function(index,item){
							var body = item.messagebody;
							var title = body.substring(body.indexOf("【"),body.indexOf("】")+1);
							var li = document.createElement('li');
							var unread = "";
							if(item.unread){
								unread = '<span class="mui-badge-unread">&nbsp;</span>'
							}
							li.className = "mui-table-view-cell list_message";
							li.innerHTML = '<a data="'+item.id+'" key="'+item.unread+'">'
											+'<img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+policenum+'"/>'
											+unread
											+'<div class="mui-media-body">'
											+'<span class="title">'+title+'</span><p class="mui-ellipsis">'+body.replace(",","").replace(title,"").substr(0,29)+'...</p>'
											+'<span class="times mui-pull-right">'+item.logtime+'</span></div></a>';
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);
					}else{							
						showWebviewToast(data.msg);
					}
					mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常!");
				}
			});
		}
		
		function taskPullUpRefresh(){
			tpage++;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'noticeList',
					policenum:policenum,
					offset:tpage,
					size:size,
					type:"task"
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						document.body.querySelector("#tasknum").innerHTML = data.result.total;
						var message = data.result.list;
						//showWebviewToast(JSON.stringify(data));
						var length = message.length;
						var ul = document.body.querySelector("#task");
						var fragment = document.createDocumentFragment();
						mui.each(message,function(index,item){
							var data = item.messagebody;
							var from=item.from;
							var type="send";
							if(from!=policenum){
								type="accept";
							}
							var unread = "";
							if(item.unread){
								unread = '<span class="mui-badge-unread">&nbsp;</span>'
							}
							var title = data.substring(data.indexOf("【"),data.indexOf("】")+1);
							var li = document.createElement('li');
							li.className = "mui-table-view-cell list_message";
							li.innerHTML = '<a data_taskid="'+item.taskid+'" key="'+item.unread+'" data_type="'+type+'" href="tdetail.php?id='+item.id+'&policenum='+policenum+'">'
											+'<img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+policenum+'">'
											+ unread
											+'<div class="mui-media-body">'
											+'<span class="title">'+title+'</span><span class="times mui-pull-right">'+item.logtime+'</span>'
											+'<p class="mui-ellipsis">'+data.replace(",","").replace(title,"").substr(0,20)+'...</p></div></a>';
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);			
					}else{							
						showWebviewToast(data.msg);
					}
					mui('#item2mobile').pullRefresh().endPullupToRefresh(); //refresh completed
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常!");
				}
			});
		}
		
		function taskPullDownRefresh(){
			tpage = 1;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'noticeList',
					policenum:policenum,
					offset:tpage,
					size:size,
					type:"task"
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						document.body.querySelector("#tasknum").innerHTML = data.result.total;
						var message = data.result.list;
						//showWebviewToast("task>>>"+JSON.stringify(data));
						var length = message.length;
						var ul = document.body.querySelector("#task");
						var fragment = document.createDocumentFragment();
						ul.innerHTML = "";
						mui.each(message,function(index,item){
							var from=item.from;
							var type="send";
							if(from!=policenum){
								type="accept";
							}
							var unread = "";
							if(item.unread){
								unread = '<span class="mui-badge-unread">&nbsp;</span>'
							}
							var data = item.messagebody;
							var title = data.substring(data.indexOf("【"),data.indexOf("】")+1);
							var li = document.createElement('li');
							li.className = "mui-table-view-cell list_message";
							li.innerHTML = '<a data_taskid="'+item.taskid+'" key="'+item.unread+'" data_type="'+type+'" data="'+item.id+'" href="tdetail.php?id='+item.id+'&policenum='+policenum+'">'
											+'<img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+policenum+'">'
											+ unread
											+'<div class="mui-media-body">'
											+'<span class="title">'+title+'</span><span class="times mui-pull-right">'+item.logtime+'</span>'
											+'<p class="mui-ellipsis">'+data.replace(",","").replace(title,"").substr(0,20)+'...</p></div></a>';
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);			
					}else{							
						showWebviewToast(data.msg);
					}
					mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常!");
				}
			});
		}
		//消息列表跳转
		mui("#message").on("tap","a",function(){
			//获取id
			var id = this.getAttribute("data");
			//获取taskid
			var taskid=this.getAttribute("data_taskid");
			var key = this.getAttribute("key");
			if(key=="true"){
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'readUpdate',
						policenum:policenum,
						id:id
					},
					beforeSend: function(request) {
		                request.setRequestHeader("U-Auth-Token", token);
		            },
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if(data.code=="200"){
//							showWebviewToast("查看成功");
						}else{							
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
			}
			document.location.href = "mdetail.php?id="+id+"&policenum="+policenum+"&token="+token;
		});
		
		//任务列表跳转
		mui("#task").on("tap","a",function(){
			//获取id
			var id = this.getAttribute("data");
			var key = this.getAttribute("key");
			var taskid=this.getAttribute("data_taskid");
			var type=this.getAttribute("data_type");
			if(key){
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'readUpdate',
						policenum:policenum,
						id:id
					},
					beforeSend: function(request) {
		                request.setRequestHeader("U-Auth-Token", token);
		            },
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if(data.code=="200"){
//							showWebviewToast("查看成功");
						}else{							
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
			}
			document.location.href = "../task/taskdetail.php?id="+taskid+"&pageType="+type;
//			window.javaInterface.showWebviewToast('任务消息跳转页面维护中!');
		});
		
		mui.ready(function() {
			mui('#item1mobile').pullRefresh().pulldownLoading();
			mui('#item2mobile').pullRefresh().pulldownLoading();
		});
		
		setTitle("消息中心");
	})(mui);
</script>
</body>
</html>