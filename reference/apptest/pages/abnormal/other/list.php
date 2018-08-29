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
		<title>其他异常记录</title>
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css" />
		<link rel="stylesheet" type="text/css" href="../../../css/style.css" />
		<style type="text/css">
			body,.mui-content{
				background-color: #FFF;
			}
			.mui-icon-left-nav {
				color: #FFF;
			}
			
			.mui-segmented-control .mui-control-item.mui-active {
				color: #fff;
				background-color: #1ac2ff;
			}
			.mui-segmented-control {
				border: 1px solid #1ac2ff;
			}
			
			.mui-segmented-control .mui-control-item {
				border-left: 1px solid #1ac2ff;
			}
		</style>
	</head>

	<body>
		<div class="mui-content" style="padding-bottom: 60px;background-color: #efeff4;">
			<div style="padding: 10px 10px;background-color: #FFF;">
				<div id="segmentedControl" class="mui-segmented-control"  style="background-color: #FFF;">
					<a class="mui-control-item mui-active" data-key="1" href="#item1">未处理</a>
					<a class="mui-control-item" data-key="2" href="#item2">处理中</a>
					<a class="mui-control-item" data-key="3" href="#item3">处理完成</a>
				</div>
			</div>
			<div>
				<div id="item1" class="mui-control-content mui-active mui-fullscreen" style="margin-top:56px;">
					<div id="scrollone" class="mui-content mui-scroll-wrapper">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron">
							</ul>
						</div>
					</div>
				</div>
				<div id="item2" class="mui-control-content mui-fullscreen" style="margin-top:56px;">
					<div id="scrolltwo" class="mui-content mui-scroll-wrapper">
						<div class="mui-scroll">
							<ul class="mui-table-view mui-table-view-chevron">
							</ul>
						</div>
					</div>
				</div>
				<div id="item3" class="mui-control-content mui-fullscreen" style="margin-top:56px;">
					<div id="scrollthree" class="mui-content mui-scroll-wrapper">
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
			//1 未处理 2处理中 3 处理完成
			(function($) {
				var policenum = getPolicenum();
				var token = getToken();
				var type = <?php echo "'". $_GET["type"] . "'" ?>;
				var department = <?php echo "'". $_GET["department"] . "'" ?>;
				var limit = 10;
				var offsetone = 1;
				var offsettwo = 1;
				var offsetthree = 1;
				
				mui('#scrollone').pullRefresh({
					up: {
						contentrefresh: "正在加载...",
						callback: scroll1onePullUpRefresh
					},
					down:{
						contentrefresh: "正在加载...",
						callback: scroll1onePullDownRefresh
					}
				});
				
				mui('#scrolltwo').pullRefresh({
					up: {
						contentrefresh: "正在加载...",
						callback: scroll1twoPullUpRefresh
					},
					down:{
						contentrefresh: "正在加载...",
						callback: scroll1twoPullDownRefresh
					}
				});
				
				mui('#scrollthree').pullRefresh({
					up: {
						contentrefresh: "正在加载...",
						callback: scroll1threePullUpRefresh
					},
					down:{
						contentrefresh: "正在加载...",
						callback: scroll1threePullDownRefresh
					}
				});
				
				function scroll1onePullUpRefresh(){
					offsetone++;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsetone,
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
								mui('#scrollone').pullRefresh().endPullupToRefresh(); //refresh completed			
							}else{							
								mui.alert(data.msg, '警告信息');
							}
						},
						error:function(xhr,type,errorThrown){
							mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});
				}
				
				function scroll1onePullDownRefresh(){
					offsetone = 1;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsetone,
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
								mui('#scrollone').pullRefresh().endPulldownToRefresh(); //refresh completed			
							}else{							
								mui.alert(data.msg, '警告信息');
							}
						},
						error:function(xhr,type,errorThrown){
							mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});
				}
				
				
				function scroll1twoPullUpRefresh(){
					offsettwo++;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsettwo,
							status:2
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'GET',//HTTP请求类型
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
								mui('#scrolltwo').pullRefresh().endPullupToRefresh(); //refresh completed			
							}else{							
								//mui.alert(data.msg, '警告信息');
							}
						},
						error:function(xhr,type,errorThrown){
							//mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});
				}
				
				function scroll1twoPullDownRefresh(){
					offsettwo = 1;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsettwo,
							status:2
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'GET',//HTTP请求类型
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
								mui('#scrolltwo').pullRefresh().endPulldownToRefresh(); //refresh completed			
							}else{							
								//mui.alert(data.msg, '警告信息');
							}
						},
						error:function(xhr,type,errorThrown){
							//mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});
				}
				
				function scroll1threePullUpRefresh(){
					offsetthree++;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsetthree,
							status:3
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'GET',//HTTP请求类型
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
								mui('#scrollthree').pullRefresh().endPullupToRefresh(); //refresh completed		
							}else{							
								mui.alert(data.msg, '警告信息');
							}
						},
						error:function(xhr,type,errorThrown){
							mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});		
				}
				
				function scroll1threePullDownRefresh(){
					offsetthree = 1;
					mui.ajax(basePath+'/osapi/attendance.php',{
						data:{
							action:'otherExceptionsRecordDepartment',
							policenum:policenum,
							department:department,
							type:type,
							limit:limit,
							offset:offsetthree,
							status:3
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'GET',//HTTP请求类型
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
								mui('#scrollthree').pullRefresh().endPulldownToRefresh(); //refresh completed		
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
					mui('#scrollone').pullRefresh().pulldownLoading();
					mui('#scrolltwo').pullRefresh().pulldownLoading();
					mui('#scrollthree').pullRefresh().pulldownLoading();
				});
				
				mui(".mui-table-view").on("tap","a.mui-navigate-right",function(){
					//获取id
					var id = this.getAttribute("data-key");
					var key = this.getAttribute('data-data');
					document.location.href = "detail.php?id="+id+"&token="+token+"&policenum="+key+'&type='+type;
				});
						
				setTitle('异常列表');  //设置title
			})(mui);
		</script>
	</body>

</html>