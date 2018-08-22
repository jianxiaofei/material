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
			.mui-icon-left-nav {
				color: #FFF;
			}
			
			.mui-segmented-control .mui-control-item.mui-active {
				color: #fff;
				background-color: #1ac2ff;
			}
			
			.mui-control-content {
				height: 150px;
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
		<div class="mui-content">
			<ul class="mui-table-view mui-grid-view" id="leader-content">
				
			</ul>
		</div>
		<script src="../../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			//1 未处理 2处理中 3 处理完成
			(function($) {
				var token = window.javaInterface.getToken();
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getExceptionType'
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
							var ul = document.body.querySelector('#leader-content');
							for(var i=0;i<list.length;i++){
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell mui-media mui-col-xs-3';
								li.innerHTML = '<a href="other/department.php?id='+d[0]+'&token='+token+'"><div class="error-circle" style="background-color: '+color+';">'+
											   '<div class="title">'+dep+'</div></div></a>';
								leader_content.appendChild(li);
							}
						}else{							
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});	
				window.javaInterface.setTitle('异常分类列表');  //设置title
			})(mui);
		</script>
	</body>

</html>