<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>我的异常记录</title>
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css" />
		<style type="text/css">		
		.mui-content,body {
			color:#888888;
			background-color:#ffffff;
		}
			
		.mui-icon-left-nav {
			color: #FFF;
		}
		
		.mui-media-object {
			border-radius:50%;
		}
		
		.mui-segmented-control .mui-control-item.mui-active {
			color: #fff;
			background-color: #1ac2ff;
		}
		
		.mui-control-content {
			min-height: 64px;
		}
			
		.mui-segmented-control {
			border: 1px solid #1ac2ff;
		}
		
		.mui-segmented-control .mui-control-item {
			border-left: 1px solid #1ac2ff;
		}
		
		.mui-table-view:before ,.mui-table-view:after {
			background-color:#ffffff;
		}
		
		.mui-table-view-cell:after {
			background-color:#c8c7cc;
			left:15px;
			
		}
		.mui-table-view-cell:last-child:after {
			height:1px;
		}
		
		
		</style>
	</head>

	<body>
		<div class="mui-content" >
			<div style="padding: 10px 10px;">
				<div id="segmentedControl" class="mui-segmented-control">
					<a class="mui-control-item mui-active" data-key="1" href="#item1">未处理</a>
					<a class="mui-control-item" data-key="2" href="#item2">处理中</a>
					<a class="mui-control-item" data-key="3" href="#item3">处理完成</a>
				</div>
			</div>
			<div>
				<div id="item1" class="mui-control-content mui-active mui-fullscreen" style="margin-top:56px;">
					<div id="one" class="mui-content mui-scroll-wrapper">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron">
							</ul>
						</div>
					</div>
				</div>
				<div id="item2" class="mui-control-content mui-fullscreen" style="margin-top:56px;">
					<div id="two" class="mui-content mui-scroll-wrapper">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron">
							</ul>
						</div>
					</div>
				</div>
				<div id="item3" class="mui-control-content mui-fullscreen" style="margin-top:56px;">
					<div id="three" class="mui-content mui-scroll-wrapper">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			
			var policenum = getPolicenum();
			var token = getToken();
			var type = <?php echo "'". $_GET["type"] . "'" ?>;
			var limit = 10;
			var offset1 = 1;
			var offset2 = 1;
			var offset3 = 1;
			mui('#one').pullRefresh({
				up: {
					contentrefresh: "正在加载...",
					callback: onePullUpRefresh
				},
				down:{
					contentrefresh: "正在加载...",
					callback: onePullDownRefresh
				}
			});
			
			mui('#two').pullRefresh({
				up: {
					contentrefresh: "正在加载...",
					callback: twoPullUpRefresh
				},
				down:{
					contentrefresh: "正在加载...",
					callback: twoPullDownRefresh
				}
			});
			
			mui('#three').pullRefresh({
				up: {
					contentrefresh: "正在加载...",
					callback: threePullUpRefresh
				},
				down:{
					contentrefresh: "正在加载...",
					callback: threePullDownRefresh
				}
			});
			
			function onePullUpRefresh(){
				offset1++;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset1,
						status:1
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
							var ul = document.body.querySelector('#item1 ul');
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#one').pullRefresh().endPullupToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			function onePullDownRefresh(){
				offset1 = 1;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset1,
						status:1
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
							var ul = document.body.querySelector('#item1 ul');
							ul.innerHTML = null;
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#one').pullRefresh().endPulldownToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			function twoPullUpRefresh(){
				offset2++;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset2,
						status:2
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
							var ul = document.body.querySelector('#item2 ul');
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#two').pullRefresh().endPullupToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			function twoPullDownRefresh(){
				offset2 = 1;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset2,
						status:2
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
							var ul = document.body.querySelector('#item2 ul');
							ul.innerHTML = null;
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#two').pullRefresh().endPulldownToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			function threePullUpRefresh(){
				offset3++;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset3,
						status:3
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
							var ul = document.body.querySelector('#item3 ul');
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#three').pullRefresh().endPullupToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			function threePullDownRefresh(){
				offset3 = 1;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'myAbnormalRecordList',
						policenum:policenum,
						type:type,
						limit:limit,
						offset:offset3,
						status:3
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
							var ul = document.body.querySelector('#item3 ul');
							ul.innerHTML = null;
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								var html = "";
								html += '<a class="mui-navigate-right" data-key="'+list[i].id+'" data-data="'+list[i].policenum+'">';
								html += '<img class="mui-media-object mui-pull-left" alt="" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'"/>';
								html += '<div class="mui-media-body">'+list[i].realname+'<p class="mui-pull-right">'+list[i].date.substring(0,10)+'</p>';
								
								html += '<p class="mui-ellipsis">'+list[i].typename+'</p>'
								html += '</div></a>';								
								li.innerHTML = html;
								ul.appendChild(li);
							}
							mui('#three').pullRefresh().endPulldownToRefresh(); //refresh completed			
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
			}
			
			mui.ready(function() {
				mui('#one').pullRefresh().pulldownLoading();
				mui('#two').pullRefresh().pulldownLoading();
				mui('#three').pullRefresh().pulldownLoading();
			});
			mui(".mui-table-view").on("tap","a.mui-navigate-right",function(){
				//获取id
				var id = this.getAttribute("data-key");
				var policenum = this.getAttribute('data-data');
				document.location.href = "detail.php?id="+id+"&token="+token+"&policenum="+policenum+'&type='+type;
			});
			setTitle('异常列表'); //设置title
		</script>
	</body>

</html>