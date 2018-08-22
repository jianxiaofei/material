<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>我的日程列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	<style>
		html,body,.mui-content{
			background-color: #FFF;
		}
		.add_tzgg {
			width: 55px!important;
			height: 55px!important;
			border-radius: 50%;
			position: fixed;
			right: 2%;
			bottom: 2%;
			z-index: 100;
		}
		.mui-ellipsis{
			white-space: normal;
		}
	</style>
</head>
<body class="mui-fullscreen">
	<header class="mui-bar mui-bar-nav" style="padding-left: 0;">
		<h1 class="mui-title" style="text-align: left;left: 15px;" id="title"></h1>
	</header>
	<div class="mui-content">
		<ul class="mui-table-view mui-table-view-striped mui-table-view-condensed" style="margin-top: 0;" id="richeng-list">
		</ul>
	</div>
	<script src="../../js/mui.min.js"></script>
	<script src="../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init({
			gestureConfig:{
	            tap: true, //默认为true
	            doubletap: true, //默认为false
	            longtap: true, //默认为false
	            drag: true, //默认为true
	            hold: true, //默认为false，不监听
	            release: true //默认为false，不监听
	        },
	         swipeBack: false
		});
		var policenum = getPolicenum();
		var token = getToken();
		var currentdate = getNowFormatDate();
		var sysDate = getNowFormatDate();
		
		function callByAndroid(json){
			var arr = eval("(" + json + ")");		
			currentdate = arr.date;
			getData();
		}
		
		function getData(){
			showH5Loading();
			mui.ajax(basePath+'/osapi/task.php',{
				data:{
					action:'getMyScheduleByDay',
					policenum:policenum,
					date:currentdate
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					dismissH5Loading();
					if(data.code=="200"){
						document.getElementById('title').innerHTML = currentdate+'日程列表';
						var list = data.result;
						var length = list.length;
						var table = document.body.querySelector('#richeng-list');
						table.innerHTML = "";	
						var fragment = document.createDocumentFragment();
						if(0==length){
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							li.innerHTML = '今日无日程记录';
							fragment.appendChild(li);
						}
						mui.each(list,function(index,item){
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							var html = '<div class="mui-table"><div class="mui-table-cell mui-col-xs-10">';
							html += '<h4 class="mui-ellipsis">'+item.taskname+'</h4>';
							html += '<h5">'+item.detail+'</h5>';
							html += '<p class="mui-h6 mui-ellipsis">'+item.starttime+'至'+item.endtime+'</p>';
							html += '</div><div class="mui-table-cell mui-col-xs-2 mui-text-right"><span class="mui-badge mui-badge-primary">'+item.taskLevelString+'</span></div></div>';
							li.innerHTML = html;
							fragment.appendChild(li);
						});
						table.appendChild(fragment);			
					}else{
						showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					dismissH5Loading();
					showWebviewToast("网络异常!");
				}
			});
		}
		
		(function($){	
			getData();			
		})(mui);
	</script>
</body>
</html>