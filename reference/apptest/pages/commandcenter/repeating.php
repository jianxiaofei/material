<!--
	作者：836110252@qq.com
	时间：2016-07-25
	业务描述： 交处警 （转发）
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>指挥中心任务转发</title>
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
		<div class="row mui-input-row">
			<textarea id="content" rows="10" class="mui-input-clear content" placeholder="请输入转发内容"></textarea>
		</div>		
		<ul class="mui-table-view">
			<li class="mui-table-view-cell" style="padding:0;" id="selectPeople">
				<div class="mui-input-row">
					<label style="color: #888;width: 70%;">选择转发人员(点击头像删除)</label>
					<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
				</div>
			</li>
		</ul>
		<ul id="people-list" class="mui-table-view mui-grid-view mui-grid-9">
			
		</ul>
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
	var attachments = [];
	var id = <?php echo "'". $_GET["id"] . "'" ?>;
	
	function callByAndroid(json){
		var arr = eval("(" + json + ")");
		var action = arr.action;
		if(action!="getSelectPeople"){
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
		}else{
			var people = arr.people;
			var length = people.length;
			var peoplelist = document.getElementById('people-list');
			var htm = "";
			for(var i=0;i<length;i++){
				if(people[i].userpnum.length==6){
					htm += '<li data-policenum="'+people[i].userpnum+'" data-friendname="'+people[i].friendname+'" class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">';
					htm += '<img style="width:50%;" src="'+basePath+'/osapi/avantar.php?policenum='+people[i].userpnum+'" class="mui-media-object deletePeople">';
					htm += '<div class="mui-media-body">'+people[i].friendname+'</div></li>';
				}
			}
			peoplelist.innerHTML = htm;		
		}
	}
	
	mui("#people-list").on("tap","img.deletePeople",function(){
		//
		this.parentNode.remove();
	});
	
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
	
	(function($) {				
		
		//选择转发人员
		document.getElementById('selectPeople').addEventListener("tap",function(){
			window.javaInterface.selectPeople();
		});
		
		//添加附件
		document.getElementById('selectFile').addEventListener("tap",function(){
			window.javaInterface.doFileSelect();
		});
		
		//保存
		document.getElementById("submitAddTask").addEventListener("tap",function(){
			var content = document.getElementById("content").value;
			var attachmentsArr = [];
			mui.each(attachments,function(index,item){
				attachmentsArr.push(item.id);
			});
			//var imageurls = JSON.stringify(attachments);
			var userpnum = document.getElementById("people-list").getElementsByTagName("li");
			var forwardingnum = [];
			var forwarding = [];
			mui.each(userpnum,function(index,item){
				forwardingnum.push(item.getAttribute("data-policenum"));
				forwarding.push(item.getAttribute("data-friendname"));
			});
			
			if(""==content||null==content){
				showWebviewToast("转发内容不能为空!");
				return;
			}
			showWebviewToast(forwarding.join(","));
			showWebviewToast(forwardingnum.join(","));
			
			mui.ajax(basePath+'/osapi/task_distribution_new_app.php',{
				data:{
					action:'sendTask',
					taskid:id,
					content:content,
					accept_name:forwarding.join(","),
					accept_policenum:forwardingnum.join(","),
					realname:realname,
					policenum:policenum,
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
//						mui.back();
						window.location.href = "detail.php?id="+id;
						showWebviewToast("任务转发成功!");
					}else{
						showWebviewToast(data.msg)
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		});
		
		setTitle("任务转发");
	})(mui);
</script>
</body>
</html>
