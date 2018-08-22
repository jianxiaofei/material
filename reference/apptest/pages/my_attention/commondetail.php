<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>评价列表</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			.icon-xingxing{
				color: yellow;
			}
		</style>
	</head>
	<body>
		<div class="mui-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<ul class="mui-table-view" id="list">
									
					</ul>
				</div>
			</div>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
			(function($) {
				var token = "D15F84B6-10BA-1B26-811B-48EF256A0646";
				var policenum = "666666";//window.javaInterface.getPolicenum();
				
				mui.ajax(basePath+'/osapi/evaluation.php',{
					data:{
						action:'dailyEvaluationList',
						policenum:policenum
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
							var ul = document.getElementById('list');
							ul.innerHTML = null;
							var fragment = document.createDocumentFragment();
							if(length<=0){
								var li = document.createElement('li');
								li.className = "mui-table-view-cell mui-media";
								li.innerHTML = '<p>暂无评价</p>';
								fragment.appendChild(li);
							}else{
								for(var i=0;i<length;i++){
									var item = list[i];
									var html = "";
									var li = document.createElement('li');
									li.className = "mui-table-view-cell mui-collapse";
									html += '<a class="mui-navigate-right">';
									html += '<img class="mui-media-object mui-pull-left" src="'+basePath+'/osapi/avantar.php?policenum='+item.policenum+'">';
									html += '<div class="mui-media-body">'+item.realname+'('+item.jobposition+')<p class="mui-pull-right" style="margin-right: 20px;">'+item.date+'</p>';
									html += '<p class="mui-ellipsis" style="text-indent:2rem;">'+item.content+'</p>';
									var score = item.score%2;
									if(0==score){
										for(var j=0;j<item.score/2;j++){
											html += '<i class="mui-icon icon-xingxing mui-icon-star-filled"></i>';
										}
									}else{
										for(var j=0;j<item.score/2-1;j++){
											html += '<i class="mui-icon icon-xingxing mui-icon-star-filled"></i>';
										}
										html += '<i class="mui-icon mui-icon-starhalf icon-xingxing"></i>';
									}
									html += '</div></a><div class="mui-collapse-content"><p>'+item.content+'</p>';
									if(0==score){
										for(var j=0;j<item.score/2;j++){
											html += '<i class="mui-icon icon-xingxing mui-icon-star-filled"></i>';
										}
									}else{
										for(var j=0;j<item.score/2-1;j++){
											html += '<i class="mui-icon icon-xingxing mui-icon-star-filled"></i>';
										}
										html += '<i class="mui-icon mui-icon-starhalf icon-xingxing"></i>';
									}
									html += '</div>';
									li.innerHTML = html;
									fragment.appendChild(li);
								}
							}
							ul.appendChild(fragment);
						}else{
							window.javaInterface.showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						window.javaInterface.showWebviewToast("网络异常!");
					}
				});
			})(mui);
			window.javaInterface.setTitle('评价列表'); //设置title
			
		</script>
	</body>
</html>