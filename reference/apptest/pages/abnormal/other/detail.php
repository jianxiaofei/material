<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>异常详情</title>
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css" />
		<link rel="stylesheet" type="text/css" href="../../../css/style.css" />
		<style type="text/css">
			body{
				background: #ffffff;
				font-size:14px;
			}
			.mui-content{
				background: #ffffff;
			    overflow: hidden;
			    padding: 15px;
			}
			.mui-timeline {
			    position: relative;
			    padding: 0;
			    list-style: none;
			}
			.mui-timeline:before {
			    content: '';
			    position: absolute;
			    top: 0px;
			    bottom: 0;
			    width: 2px;
			    background: #ddd;
			    left: 32px;
			    margin: 0;
			    border-radius: 2px;
			}
			.mui-timeline > li {
			    position: relative;
			    margin-bottom: 15px;
			}
			.mui-timeline > li:before,
			.mui-timeline > li:after {
			    content: " ";
			    display: table;
			}
			.mui-timeline > li:after {
			    clear: both;
			}
			.mui-timeline > li > .mui-timeline-item {
			    margin-top: 0px;
			    background: #fff;
			    color: #888888;
			    margin-left: 60px;
			    padding: 0;
			    position: relative;
			}
			.mui-timeline > li > .mui-timeline-item:after {
			    border-radius: 6px;
			    border: 1px solid #c8c7cc;
			    display: block;
			    content: '';
			    position: absolute;
			    top: 0;
			    right: 0;
			    bottom: 0;
			    left: 0;
			    -webkit-transform-origin: 0 0;
			    -webkit-transform: scale(1);
			    pointer-events: none;
			}
			
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-time {
				float:none;
			    color: #999;
			    padding: 10px;
			    font-size: 12px;
			}
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-header {
			    margin: 0;
			    color: #888888;
			    padding: 10px;
			    font-size: 0.7em;
			    position: relative;
			}
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-header:after {
			    border-bottom: 1px solid #ddd;
			    display: block;
			    content: '';
			    position: absolute;
			    top: 0;
			    right: 0;
			    bottom: 0;
			    left: 0;
			    -webkit-transform-origin: 0 0;
			    -webkit-transform: scale(1);
			    pointer-events: none;
			}
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-body,
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-footer {
			    padding: 10px;
			    font-size: 0.6rem;
			}
			.mui-timeline > li > .mui-timeline-item > .mui-timeline-footer {
			    background-color: #f4f4f4;
			}
			.mui-timeline > li.mui-time-label > span {
			    padding: 5px;
			    display: inline-block;
			    background-color: #d2d6de;
			    border-radius: 4px;
			    color: #ffffff;
			}
			.mui-timeline > li > .mui-time-label {
			    width: 50px;
			    height: 30px;
			    font-size: 0.75em;
			    line-height: 30px;
			    position: absolute;
			    color: #ffffff;
			    background: #d2d6de;
			    text-align: center;
			    left: 8px;
			    top: 0;
			    border-radius: 4px;
			}
			.mui-timeline > li > .mui-iconfont {
			    width: 30px;
			    height: 30px;
			    font-size: 15px;
			    line-height: 30px;
			    position: absolute;
			    color: #ffffff;
			    background: #d2d6de;
			    border-radius: 50%;
			    text-align: center;
			    left: 18px;
			    top: 0;
			}
			@media only screen and (-webkit-min-device-pixel-ratio: 1.5) {
			    .mui-timeline > li > .mui-timeline-item:after,
			    .mui-timeline > li > .mui-timeline-item > .mui-timeline-header:after {
			        right: -100%;
			        bottom: -100%;
			        -webkit-transform: scale(0.5);
			    }
			}
			.mui-timeline li img{
				width: 3rem;
				height: 3.6rem;
			    line-height: 3rem;
			    position: absolute;
			    border-radius: 50%;
			    text-align: center;			 
			    top: 10%;
			}
			
			.mui-card {
				color:#888888;
			}
			
			.mui-timeline-time{
				float:none;!important
			}
		</style>
	</head>
	<body>
		<div class="mui-content">
			<div class="mui-card" style="margin: 0;">
				<ul class="mui-table-view" id="info">
				</ul>
			</div>
	        <ul class="mui-timeline" id="list-info">
	        </ul>
	    	<div class="mui-row mui-text-center">
	    		<div class="mui-col-xs-4">    			
		    		<a class="mui-btn mui-btn-primary mui-col-xs-10" id="reply" href="javascript:void(0);">
							回复
					</a>
	    		</div>
				<div class="mui-col-xs-4">
					<a class="mui-btn mui-btn-primary mui-col-xs-10" id="forward" href="javascript:void(0);">
							转发
					</a>
				</div>
				<div class="mui-col-xs-4">
					<div class="mui-btn mui-btn-primary mui-col-xs-10" id="finish" href="javascript:void(0);">
							完成
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
			
			function callByAndroid(a,b){
				window.location.reload();
			}
			
			(function($) {			
				var type = <?php echo "'". $_GET["type"] . "'" ?>;	
				var id = <?php echo "'". $_GET["id"] . "'" ?>;
				var token = <?php echo "'". $_GET["token"] . "'" ?>;
				var policenum = <?php echo "'" . $_GET["policenum"] . "'" ?>;
				//var id = '11020';
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getPeopleAttendceInfoById',
						id:id,
						type:type
					},
					beforeSend: function(request) {
                        request.setRequestHeader("U-Auth-Token", token);
                    },
					dataType:'json',//服务器返回json格式数据
					type:'GET',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if(data.code=="200"){
							var html = "";
							var ul = document.body.querySelector('#info');
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							html = '异常人：'+data.result[data.result.length-1].realname+' ('+data.result[data.result.length-1].departmentname+')';
							li.innerHTML = html;
							ul.appendChild(li);
							html = "";
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							
							html = '异常类型：'+data.result[data.result.length-1].typename;
							li.innerHTML = html;
							ul.appendChild(li);
							html = "";
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							html = '异常时间：'+data.result[data.result.length-1].inserttime;
							li.innerHTML = html;
							ul.appendChild(li);
							html = "";
							var li = document.createElement('li');
							li.className = 'mui-table-view-cell';
							html = '连续天数：'+data.result[data.result.length-1].days+'天';
							li.innerHTML = html;
							ul.appendChild(li);
							
							var list_li = document.body.querySelector('#list-info');
							for(var i=0;i<data.result.length;i++){
								var detail = data.result[i];
								if(0==i){
									if("审批通过"==detail.statename){
										var li = document.createElement('li');
										li.className = 'mui-time-label';
										li.innerHTML = '<span class="mui-bg-warning" style="background-color:#007aff;">处理完成</span>';
										list_li.appendChild(li);
									}else{
										var li = document.createElement('li');
										li.className = 'mui-time-label';
										li.innerHTML = '<span class="mui-bg-warning" style="background-color:red;">待处理</span>';
										list_li.appendChild(li);
									}
								}
								if(i!=data.result.length-1){
									var li = document.createElement('li');
									li.innerHTML = '<img src="'+basePath+'/osapi/avantar.php?policenum='+detail.policenum+'" align="头像"/>'+
									'<div class="mui-timeline-item"><span class="mui-timeline-time">处理时间：'+detail.date+'</span>'+
									'<h3 class="mui-timeline-header">'+detail.statename+'</h3>'+
									'<div class="mui-timeline-body">'+detail.content+'</div></div>';
									list_li.appendChild(li);
								}
								if(i==data.result.length-1){
									var li = document.createElement('li');
									li.innerHTML = '<img src="'+basePath+'/osapi/avantar.php?policenum='+detail.policenum+'" align="头像"/>'+
									'<div class="mui-timeline-item"><span class="mui-timeline-time">异常时间：'+detail.date+'</span>'+
									'<h3 class="mui-timeline-header">'+detail.statename+'</h3>'+
									'<div class="mui-timeline-body">'+detail.content+'</div></div>';
									list_li.appendChild(li);
									var li = document.createElement('li');
									li.className = 'mui-time-label';
									li.innerHTML = '<span class="mui-bg-warning">事件起点</span>';
									list_li.appendChild(li);
								}								
							}
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
				
				//回复
				document.getElementById('reply').addEventListener('tap',function(){
					window.javaInterface.reply(id,policenum,type);
				});
				
				//转发
				document.getElementById('forward').addEventListener('tap',function(){
					window.javaInterface.forward(id,policenum,type);
				});
				
				//完成
				document.getElementById('finish').addEventListener('tap',function(){
					window.location.href = "finish.php?id="+id+"&type="+type;
				});
				
				window.javaInterface.setTitle("异常详情");  //设置title
			})(mui);
		</script>
	</body>

</html>