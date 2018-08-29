<!-- 
	模块名称：工作记录详情
	作者：836110252@qq.com
	时间：2016-07-19
	业务逻辑描述：1、根据工作日志内容模糊查询
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>工作日志搜索</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	<style>
		html,body,.mui-content{
			background-color: #FFF;
		}
		.mui-input-row label{
			font-size: 1rem;
		}
		.mui-input-row .mui-btn{
			padding: 0 !important;
		}
		.mui-table-view:before,.mui-table-view:after{
			background-color: #fff;
		}
		.datatom-nodata{
			text-align: center;
		}
		.datatom-nodata img{
			width: 30%;
		}
	</style>
</head>
	<body class="mui-fullscreen">
		<div class="mui-content mui-fullscreen">
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
			<div id="pullrefresh" class="mui-scroll-wrapper" style="margin-top: 45px;">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron" id="worklog-list">
						<li class="datatom-nodata">
							<img style="margin-top: 20px;" src="../../img/nodata.png"/>
						</li>
					</ul>
				</div>
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
			
			mui('.mui-scroll-wrapper').scroll({
				indicators: true //是否显示滚动条
			});
			
			var policenum = getPolicenum();
			var token = getToken();
			var page = 1;
			var size = 100;
			
			(function($){	
				
				document.getElementById("search").addEventListener("tap",function(){
					//showH5Loading();
					var condition = document.getElementById('condition').value;
					if(null==condition||""==condition||undefined==condition){
						showWebviewToast("请输入查询内容");
						return;
					}
					var ul = document.getElementById("worklog-list");
					ul.innerHTML = '<li class="datatom-nodata"><div class="mui-loading"><div class="mui-spinner"></div></div></li>';
					mui.ajax(basePath+'/osapi/worklog.php',{
						data:{
							action:'getworklogBywd',
							policenum:policenum,
							condition:condition,
							page:page,
							size:size
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'POST',//HTTP请求类型
						timeout:10000,//超时时间设置为10秒；
						success:function(data){
							//dismissH5Loading();
							if(data.code=="200"){
								var list = data.result;
								ul.innerHTML = "";
								var fragment = document.createDocumentFragment();
								var length = list.length;
								if(1==page&&length<=0){
									var li = document.createElement('li');
									li.className = "datatom-nodata";
									li.innerHTML = '<img style="margin-top: 20px;" src="../../img/nodata.png"/>';
									fragment.appendChild(li);
								}
								mui.each(list,function(index,item){
									var htm = "";
									var detail = eval("(" + item.detail + ")");
									var detailStr = "";
									mui.each(detail,function(index,item2){
										if(0==item2.type){
											detailStr = item2.text;
										}
									});
									detailStr = detailStr.length>40?detailStr.substring(0,20)+'...':detailStr;
									var li = document.createElement('li');
									li.className = "mui-table-view-cell";
									htm += '<a class="mui-navigate-right" data-key="'+item.id+'"><div class="mui-media-body">';
									htm += '<h5 class="mui-ellipsis-2">'+detailStr+'</h5>';
									htm += '<p class="mui-h6 mui-ellipsis">';
									if(item.attachements.length>0){
										htm += '<span class="mui-badge mui-badge-warning">有附件</span>';
									}
									htm += '<span class="mui-pull-right">记录时间：'+item.logtime+'</span></p></div></a>';
									li.innerHTML = htm;
									fragment.appendChild(li);
								});
								ul.appendChild(fragment);
							}else{
								showWebviewToast(data.msg);
							}
						},
						error:function(xhr,type,errorThrown){	
							//dismissH5Loading();					
							showWebviewToast("网络异常!");
						}
					});
				});
				
				mui("#worklog-list").on("tap","a.mui-navigate-right",function(){
					//获取id
					var id = this.getAttribute("data-key");
					window.javaInterface.startDefaultHtmlActivity(basePath+'/extapp/app/html5/workrecord/detail.php?id='+id);
				});
				
				setTitle("工作日志搜索");
			})(mui);
		</script>
	</body>
</html>
