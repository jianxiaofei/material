<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：我的申请
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>我的申请</title>
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
		.mui-slider .mui-segmented-control.mui-segmented-control-inverted~.mui-slider-group .mui-slider-item {
			border:none;
		}
		.list-status{
			position: absolute;
			right: 10%;
			width: 16% !important;
			top: 0;
		}
		.mui-table-view .mui-active{
			background-color: #FFF;!important
		}
		.datatom-tran{
			top: 10%;
			transform:rotate(-27deg);
			-ms-transform:rotate(-27deg); 	/* IE 9 */
			-moz-transform:rotate(-27deg); 	/* Firefox */
			-webkit-transform:rotate(-27deg); /* Safari 和 Chrome */
			-o-transform:rotate(-27deg); 	/* Opera */
		}
		.mui-ellipsis{
			font-size: .5rem;
		}
	</style>
</head>
<body>
<div class="mui-content">
	<div id="slider" class="mui-slider mui-fullscreen">
		<div id="sliderSegmentedControl"
			 class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
			<a class="mui-control-item item1mobile" id="xiaoxi" href="#item1mobile">
				考勤
			</a>
			<!--<span>|</span>-->
			<a class="mui-control-item item2mobile" id="tesks" href="#item2mobile">
				请假
			</a>
			<a class="mui-control-item item2mobile" id="tesks" href="#item3mobile">
				加班
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
			<div id="item2mobile" class="mui-content mui-scroll-wrapper mui-slider-item mui-control-content">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron" id="qingjia">
						
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
<script src="../../js/mui.min.js"></script>
<script src="../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init({
		swipeBack: false
	});
	(function ($) {
		var policenum = "005566";//getPolicenum();
		var token = "2DD7B68C-340F-ABBE-C8E2-14E902818CFC";//getToken();
		
		var size = 10;
		var kqpage = 1;
		var qjpage = 1;
		var jbpage = 1;
		
		
		//我的申请-考勤
		mui('#item1mobile').pullRefresh({
			up: {
				contentrefresh: "正在加载...",
				callback: kqPullUpRefresh
			},
			down:{
				contentrefresh: "正在加载...",
				callback: kqPullDownRefresh
			}
		});
		
		//我的申请-请假
		mui('#item2mobile').pullRefresh({
			up: {
				contentrefresh: "正在加载...",
				callback: qjPullUpRefresh
			},
			down:{
				contentrefresh: "正在加载...",
				callback: qjPullDownRefresh
			}
		});
		
		//我的考勤下拉刷新
		function kqPullDownRefresh(){
			kqpage = 1;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'getApplyErrorList_new',
					policenum:policenum,
					offset:(kqpage-1)*size+1,
					limit:size
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						var list = data.result;
						var length = list.length;
						var ul = document.getElementById('kaoqin');
						var fragment = document.createDocumentFragment();
						ul.innerHTML = "";
						mui.each(list,function(index,item){
							var li = document.createElement('li');
							li.className = "mui-table-view-cell";
							var html = "";
							if(item.status==1){//待审核
								html += '<img src="../../img/wdsqshtg.png" class="list-status datatom-tran"/>';
							}else if(item.status==2){
								html += '<img src="../../img/wdshshwtg.png" class="list-status datatom-tran"/>';
							}else{
								html += '<img src="../../img/readyapply.png" class="list-status datatom-tran"/>';
							}
							html += '<a class=""><img class="mui-media-object mui-pull-left" src="../../img/myapplytime.png"/>';
							html +=	'<div class="mui-media-body">正常<p class="mui-pull-right">'+item.date+'('+item.week+')</p>';
							html += '<p class="mui-ellipsis">我的考勤申请</p></div></a>';
							li.innerHTML = html;
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);
						mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed			
					}else{							
						mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed	
						window.javaInterface.showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					mui('#item1mobile').pullRefresh().endPulldownToRefresh(); //refresh completed			
					window.javaInterface.showWebviewToast("网络异常!");
				}
			});
		}
		//我的考勤上拉加载更多
		function kqPullUpRefresh(){
			kqpage++;
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'getApplyErrorList_new',
					policenum:policenum,
					offset:(kqpage-1)*size+1,
					limit:size
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						var list = data.result;
						var length = list.length;
						var ul = document.getElementById('kaoqin');
						var fragment = document.createDocumentFragment();
						mui.each(list,function(index,item){
							var li = document.createElement('li');
							li.className = "mui-table-view-cell";
							var html = "";
							if(item.status==1){//待审核
								html += '<img src="../../img/wdsqshtg.png" class="list-status datatom-tran"/>';
							}else if(item.status==2){
								html += '<img src="../../img/wdshshwtg.png" class="list-status datatom-tran"/>';
							}else{
								html += '<img src="../../img/readyapply.png" class="list-status datatom-tran"/>';
							}
							html += '<a class=""><img class="mui-media-object mui-pull-left" src="../../img/myapplytime.png"/>';
							html +=	'<div class="mui-media-body">正常<p class="mui-pull-right">'+item.date+'('+item.week+')</p>';
							html += '<p class="mui-ellipsis">我的考勤申请</p></div></a>';
							li.innerHTML = html;
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);
						mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed			
					}else{							
						mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed		
						window.javaInterface.showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					mui('#item1mobile').pullRefresh().endPullupToRefresh(); //refresh completed		
					window.javaInterface.showWebviewToast("网络异常!");
				}
			});
		}
		
		//我的请假下拉刷新
		function qjPullDownRefresh(){
			qjpage = 1;
			mui.ajax(basePath+'/osapi/leave.php',{
				data:{
					action:'listmyapply_new',
					policenum:policenum,
					offset:(qjpage-1)*size+1,
					limit:size
				},
				beforeSend: function(request) {
	                request.setRequestHeader("U-Auth-Token", token);
	            },
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						var list = data.result;
						var length = list.length;
						var ul = document.getElementById('qingjia');
						var fragment = document.createDocumentFragment();
						ul.innerHTML = "";
						mui.each(list,function(index,item){
							var li = document.createElement('li');
							li.className = "mui-table-view-cell";
							var html = "";
							if(item.status==1){//待审核
								html += '<img src="../../img/wdsqshtg.png" class="list-status datatom-tran"/>';
							}else if(item.status==2){
								html += '<img src="../../img/wdshshwtg.png" class="list-status datatom-tran"/>';
							}else{
								html += '<img src="../../img/readyapply.png" class="list-status datatom-tran"/>';
							}
							html += '<a class=""><img class="mui-media-object mui-pull-left" src="../../img/myapplytime.png"/>';
							html +=	'<div class="mui-media-body">正常<p class="mui-pull-right">'+item.date+'('+item.week+')</p>';
							html += '<p class="mui-ellipsis">我的请假申请</p></div></a>';
							li.innerHTML = html;
							fragment.appendChild(li);
						});
						ul.appendChild(fragment);
						mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed			
					}else{							
						mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed	
						window.javaInterface.showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					mui('#item2mobile').pullRefresh().endPulldownToRefresh(); //refresh completed			
					window.javaInterface.showWebviewToast("网络异常!");
				}
			});
		}
		
		//我的请假上拉加载更多
		function qjPullUpRefresh(){
			
		}
		
		//我的申请
		//考勤 /osapi/attendance.php  getApplyErrorList_new policenum limit offset
		//请假  /osapi/leave.php  listmyapply_new 
		//加班 /osapi/attendance.php getApplyOvertimeList_new
		
		//我的审批
		//考勤 getAuditErrorList_new /osapi/attendance.php
		//考勤 listmyaudit_new /osapi/leave.php
		//考勤 getAuditOvertimeList_new /osapi/attendance.php
		//window.javaInterface.setTitle('我的申请'); //设置title
		
		mui.ready(function() {
			mui('#item1mobile').pullRefresh().pulldownLoading();
			mui('#item2mobile').pullRefresh().pulldownLoading();
		});
		
	})(mui);
</script>
</body>
</html>
