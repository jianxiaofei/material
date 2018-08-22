<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：其它以及部门统计完成
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>异常完成</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../../css/mui.min.css">
		<link rel="stylesheet" href="../../../css/iconfont.css" />
		<style>
			html,
			body {
				background-color: #efeff4;
			}
			.mui-input-row textarea{
				width: 100%;
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
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<div class="content-block" style="margin-bottom: 10px;">
						<i class="mui-icon mui-icon-info-filled" style="color: #888;font-size: 1rem;">
							<p style="color: #888;font-size: .8rem;">友情提示：</p>
							<p style="color: #888;font-size: .8rem;">将异常终止完成需要填写相关理由,以及处理之后发生的一切后果由处理人承担。</p>
						</i>
					</div>
					<div class="mui-input-row">
						<textarea id="content" cols="*" rows="10" placeholder="请输入终止完成理由(必填)"></textarea>
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
					<div class="mui-button-row" style="margin-top: 20px;text-align: center;">
						<button id="submitFinish" type="button" class="mui-btn" style="width: 90%;height: 46px;background-color: #003b79;color: #fff;">提交</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="../../../js/mui.min.js "></script>
	<script src="../../../js/common.js" charset="UTF-8"></script>
	<script>
		mui.init();
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
		
		var policenum = getPolicenum();
		var token = getToken();
		var realname = getRealname();
		var id = <?php echo "'". $_GET["id"] . "'" ?>;
		var type = <?php echo "'". $_GET["type"] . "'" ?>;
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
				+ '<img class="mui-media-object mui-pull-left" src="../../../img/txt.png"/>'
				+ '<div class="mui-media-body">'+fname.substring(fname.length-20,fname.length)+'<p class="mui-pull-right" style="padding:0px;"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="'+item.id+'"></span></p>'
				+ '</div></a>';
				document.getElementById('attachment-list').appendChild(li);
			}
		}
		
		(function($) {
			
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
			
			//完成
			document.getElementById('submitFinish').addEventListener("tap",function(){
				var content = document.getElementById('content').value;
				if(null==content||""==content||undefined==content){
					showWebviewToast("请输入终止完成理由");
					return;
				}
				mui.ajax(basePath+'/osapi/abnormal.php',{
					data:{
						action:'stopAbnormal',
						policenum:policenum,
						id:id,
						realname:realname,
						content:content,
						type:type,
						pictureid:JSON.stringify(attachments)
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if(data.code=="200"){
							showWebviewToast("处理成功！");
							return;
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast('网络异常!');
					}
				});
			});
			
			document.getElementById("selectFile").addEventListener("tap",function(){
				window.javaInterface.doFileSelect();
			});
			
			setTitle('异常完成');  //设置title
		})(mui);
	</script>

</html>