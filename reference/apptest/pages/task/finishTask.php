<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>任务完成</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	
		<link rel="stylesheet" href="../../css/iconfont.css" />
	<style>
		html,body,.mui-content{
			background-color: #FFF;
		}
		.mui-content p{
			padding: 10px 15px 0;
		}
		.mui-content textarea{
			height: 15rem;
		    margin-bottom: 0 !important;
		    padding-bottom: 0 !important;
		    border-top: 0 !important;
		    border-left: 0 !important;
		    border-right: 0 !important;
		}
		.tom-header{
			-webkit-box-shadow: 0 1px 6px #ccc;
    		box-shadow: 0 1px 6px #ccc;
			height: 44px;
			line-height: 44px;
			text-align: center;
		    padding-right: 10px;
		    padding-left: 10px;
		    border-bottom: 0;
		    background-color: #f7f7f7;
		    -webkit-box-shadow: 0 0 1px rgba(0,0,0,.85);
		    box-shadow: 0 0 1px rgba(0,0,0,.85);
		    -webkit-backface-visibility: hidden;
		    backface-visibility: hidden;
		    color: #888;
		}
		
		textarea::-webkit-input-placeholder {
			color: #888 !important;
			font-size: 14px !important;
		}
		textarea:-moz-placeholder {
			color: #888 !important; 
			font-size: 14px !important;
		}
		textarea::-moz-placeholder {
			color: #888 !important; 
			font-size: 14px !important;
		}
		textarea:-ms-input-placeholder {
			color: #888 !important; 
			font-size: 14px !important;
		}
		.attachment-list img{
			width: 20px !important;
			height: 20px !important;
			line-height: 20px !important;
		}
		.datatom-icon-delete{
				color: red;
			}
	</style>
</head>
<body class="mui-fullscreen">
	<div class="mui-content">
		<div class="row mui-input-row">
			<textarea id="content" rows="10" class="mui-input-clear content" placeholder="请输入完成内容"></textarea>
		</div>	
		<ul class="mui-table-view">
			<li class="mui-table-view-cell" style="padding:0;" id="selectFile">
				<div class="mui-input-row">
					<label style="color: #888;">选择附件</label>
					<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
				</div>
			</li>
		</ul>
		<ul id="attachment-list" class="mui-table-view"><!--
			<li class="mui-table-view-cell mui-media">
				<a class="attachment-list">
					<img class="mui-media-object mui-pull-left" src="../../img/txt.png"/>
					<div class="mui-media-body">123<p class="mui-pull-right"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete"></span></p>
					</div>
				</a>
			</li>-->
		</ul>
		<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
			<button id="submitCompleteTask" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
		</div>
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
		var taskid = <?php echo "'". $_GET["id"] . "'" ?>;
		var attachments = [];
		//删除附件:暂时服务器的未删除  只删除了页面显示的
		mui("#attachment-list").on("tap","span.deleteAttachment",function(){
			//
			this.parentNode.parentNode.parentNode.parentNode.remove();
			var key = this.getAttribute("data-key");
			var arr = [];
			mui.each(attachments,function(index,item){
				if(item.id!=key){
					arr.push(item);
				}
			});
			attachments = arr;
		});
		
		function callByAndroid(json){
			var arr = eval("(" + json + ")");
			var files = arr.files;
			attachments = files;
			var length = files.length;
			for(var i=0;i<length;i++){
				var item = files[i];
				var fname = item.name;	
				var li = document.createElement('li');
				li.className = "mui-table-view-cell mui-media";
				li.innerHTML += '<a class="attachment-list">'
				+ '<img class="mui-media-object mui-pull-left" src="../../img/txt.png"/>'
				+ '<div class="mui-media-body">'+fname.substring(fname.length-20,fname.length)+'<p class="mui-pull-right" style="padding:0px;"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="'+item.id+'"></span></p>'
				+ '</div></a>';
				document.getElementById('attachment-list').appendChild(li);
			}
		}
		(function($){
			
			document.getElementById("selectFile").addEventListener("tap",function(){
				window.javaInterface.doFileSelect();
			});
			
			document.getElementById('submitCompleteTask').addEventListener("tap",function(){
				var content = document.getElementById('content').value;
				if(null==content||""==content||undefined==content){
					showWebviewToast("请输入完成内容");
					return;
				}
				var arr = [];
				mui.each(attachments,function(index,item){
					arr.push(item.id);
				});
				mui.ajax(basePath+'/osapi/task.php',{
					data:{
						action:"finishTask",
						taskid:taskid,
						attachments:JSON.stringify(arr),
						policenum:policenum,
						content:content,
						comment:content
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						window.location.reload();
						showWebviewToast("任务完成成功!");
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常");
					}
				});
			});
			
			setTitle("任务完成");
		})(mui);		
	</script>
</body>
</html>