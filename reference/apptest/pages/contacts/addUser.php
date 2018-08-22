<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加好友</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css"/>
	<style>
		header,header a,header h1{
    		height: 48px;
    	}
    	p {
				text-indent: 22px;
			}
	</style>
</head>
<body>
	<header class="mui-bar mui-bar-nav" style="background-color: #003b79;">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #fff;"></a>
		<h1 class="mui-title" style="color: #fff;font-weight: bold;">添加好友</h1>
	</header>
	<div class="mui-content">		
		<div class="mui-content-padded" style="margin: 5px;">
			<select class="mui-btn mui-btn-block" style="padding: 8px;" id="groupId">
				
			</select>
		</div>
		<div class="content-block" style="margin-top: 10px;">
			<i class="mui-icon mui-icon-info-filled" style="color: #888;font-size: 1rem;">
				<p style="color: #888;font-size: .8rem;">友情提示：</p>
				<p style="color: #888;font-size: .8rem;">列表信息左滑可以添加好友</p>
			</i>
		</div>
		<div class="mui-content-padded">
			<div class="mui-row">
			    <div class="mui-search mui-col-xs-9 mui-col-sm-9">
			      <label class="icon icon-search" for="search"></label>
			      <input id="condition" type="search" placeholder="请输入查询内容"/>
			    </div>
			    <div class="mui-col-xs-3 mui-col-sm-3" style="text-align: center;">
			    	<button id="search" type="button" class="mui-btn" style="background-color: #003b79;color: #fff;">搜&nbsp;&nbsp;&nbsp;索</button>
			    </div>
			</div>
		</div>
		<ul class="mui-table-view">
			
		</ul>
	</div>
<script src="../../js/mui.min.js"></script>
<script src="../../js/common.js" charset="UTF-8"></script>
<script src="../../js/utils.js"></script>
<script>
		mui.init({
	        swipeBack: true,
    		beforeback: function() {
			//获得列表界面的webview
			var i = plus.webview.getWebviewById('main-tab-webview-subpage-contacts.html');
			i.reload(true);
			//触发列表界面的自定义事件（refresh）,从而进行数据刷新
//			mui.fire(i, 'getUserInfo()');
			LL('22222');
			//返回true，继续页面关闭逻辑
			return true;
			},
		});
	mui.plusReady(function(){
		var policenum = plus.storage.getItem("policenum");
		var token = plus.storage.getItem("token");
		mui.ajax(basePath+'/osapi/friend.php',{
			data:{
				action:'listmygroup',
				userpnum:policenum
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
					var html = '';
					html += "<option disabled='disabled'>请选择分组</option>";
					for(var i=0;i<length;i++){
						html += "<option value='"+list[i].groupid+"'>"+list[i].groupname+"</option>";
					}
					html += "</select>";
					document.getElementById("groupId").innerHTML = html;
				}else{
					mui.alert(data.msg);
				}
			},
			error:function(xhr,type,errorThrown){
				mui.alert('请求失败！请检查网络是否异常!', '警告信息');
			}
		});
		
		document.getElementById("search").addEventListener("tap",function(){
			var like = document.getElementById('condition').value;
			if(null==like||undefined==like||""==like){
				showWebviewToast("请输入搜索条件");
				return;
			}
			mui.ajax(basePath+'/osapi/user.php',{
				data:{
					action:'searchusers',
					like:like
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						var count = data.result.count;
						var list = data.result.rows;
						var ul = document.body.querySelector('.mui-table-view');
						ul.innerHTML = null;
						if(count<=0){
							var li = document.createElement('li');
							li.className = "mui-table-view-cell";
							li.innerHTML = "暂无搜索结果"
							ul.appendChild(li);
						}else{
							for(var i=0;i<count;i++){
								var name = list[i].realname.replace(like,"<em style='color:red;'>"+like+"</em>");
								var jybh = list[i].policenum.replace(like,"<em style='color:red;'>"+like+"</em>");
								var interphone = list[i].interphone==""||null==list[i].interphone?"暂无":list[i].interphone;
								var li = document.createElement('li');
								li.className = "mui-table-view-cell";
								li.innerHTML =  '<div class="mui-slider-right mui-disabled">'
											    +'<a class="mui-btn mui-btn-yellow mui-icon mui-icon-personadd itemAdd" data-key="'+list[i].policenum+'"></a></div>'
											    +'<div class="mui-slider-handle"><img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+list[i].policenum+'" style="border-radius:50%;">'
												+'<div class="mui-media-body" style="font-size: .6rem;">'
												+name+'(<font style="color: red;">'+list[i].jobposition+'</font>)<span class="mui-pull-right" style="font-size: .5rem;">'+list[i].departmentname+'</span>'
												+'<p class="mui-ellipsis">警员编号：<em>'+jybh+'</em><em class="mui-pull-right">呼号：'+interphone+'</em></p>'
												+'</div></div>';
								ul.appendChild(li);
							}
						}
					}else{
						mui.alert(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					mui.alert('请求失败！请检查网络是否异常!', '警告信息');
				}
			});
		});
		
		mui('.mui-table-view').on('tap', 'a.itemAdd',function() {
			var friendpnum = this.getAttribute("data-key");
			var groupId = document.getElementById("groupId").value;
			var btnArray = ['否', '是'];
			mui.confirm('添加好友，确认？', '友情提示', btnArray, function(e) {
				if (e.index == 1) {
					mui.ajax(basePath+'/osapi/friend.php',{
						data:{
							action:'addfriend',
							userpnum:policenum,
							friendpnum:friendpnum,
							groupid:groupId
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'POST',//HTTP请求类型
						timeout:10000,//超时时间设置为10秒；
						success:function(data){
							if(data.code=="200"){
								mui.toast("添加好友成功！");
								return;
							}else{
								mui.alert(data.msg);
							}
						},
						error:function(xhr,type,errorThrown){
							mui.alert('请求失败！请检查网络是否异常!', '警告信息');
						}
					});
				}
			});
		});
	});
</script>
</body>
</html>