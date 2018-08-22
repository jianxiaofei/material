<!--
	作者：836110252@qq.com
	时间：2016-07-25
	业务描述：
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>指挥中心任务回复</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" href="../../css/mui.min.css">
	<link rel="stylesheet" href="../../css/iconfont.css" />
	<style>
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
		<div class="mui-card">
			<div class="mui-card-header">请选择回复人</div>
			<div class="mui-card-content" id="selectPeople">
				
			</div>
		</div>
		<div class="row mui-input-row">
			<textarea id="content" rows="10" class="mui-input-clear content" placeholder="请输入回复内容"></textarea>
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
			<button id="submitAddTask" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
		</div>
	</div>
<script src="../../js/mui.min.js" charset="UTF-8"></script>
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
				
	var token = getToken();
	var policenum = getPolicenum();
	var realname = getRealname();
	var id = <?php echo "'". $_GET["id"] . "'" ?>;
	var attachments = [];
	
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
	
	function getAllPeopleBytask(key){
		mui.ajax(basePath+'/osapi/task_distribution_new_app.php',{
			data:{
				action:'getAllPeopleBytask',
				taskid:key
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
					var selectPeople = document.getElementById('selectPeople');
					var htm = "";
					mui.each(list,function(index,item){
						if(item[0]!=policenum){
							htm += '<div class="mui-input-row mui-checkbox mui-left">';
						htm += '<label>'+item[1]+'('+item[0]+')</label>';
						htm += '<input data-key="'+item[1]+'" name="checkbox" value="'+item[0]+'" type="checkbox"/></div>';
						}
					});
					selectPeople.innerHTML = htm;
				}else{
					showWebviewToast(data.msg);
				}
			},
			error:function(xhr,type,errorThrown){
				showWebviewToast("网络异常");
			}
		});
	}
	
	(function($) {				
		
		getAllPeopleBytask(id);
		
		//添加附件
		document.getElementById('selectFile').addEventListener("tap",function(){
			window.javaInterface.doFileSelect();
		});
		
		//保存
		document.getElementById("submitAddTask").addEventListener("tap",function(){
			var usernumArr = [];
			var usernameArr = [];
			var attachmentsArr = [];
			mui.each(attachments,function(index,item){
				attachmentsArr.push(item.id);
			});
			mui('#selectPeople input[name="checkbox"]:checked').each(function(){ 
				usernumArr.push(this.value); 
				usernameArr.push(this.getAttribute('data-key'));
			}); 
			var content = document.getElementById("content").value;
			//var imageurls = JSON.stringify(attachments);
			
			if(""==content||null==content){
				showWebviewToast("回复内容不能为空!");
				return;
			}
			mui.ajax(basePath+'/osapi/task_distribution_new_app.php',{
				data:{
					action:'replyTask',
					policenum:policenum,
					taskid:id,
					name:realname,
					usernum:usernumArr.join(","),
					username:usernameArr.join(","),
					content:content,
					enclosureid:attachmentsArr.join(",")
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						window.location.href = "detail.php?id="+id;
						showWebviewToast("任务回复成功!");
					}else{
						showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		});
		
		setTitle("任务回复");
	})(mui);
</script>
</body>
</html>
