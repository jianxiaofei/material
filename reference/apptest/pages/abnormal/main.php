<!--
作者：836110252@qq.com
时间：2016-05-29
描述：1、异常分类为  我的异常记录    其它与自己有关的异常记录  所属部门以下所有的异常统计
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">		
		<title>
			异常监控
		</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../../css/mui.min.css" />
		<style type="text/css">
		body {
			color:#888888;
		}
		
		#leader-content {
			color:#ffffff;
		}
		
		.mui-icon-left-nav {
			color: #FFF;
		}
		
		.error-circle {
			margin: 0 auto;
			width: 4rem;
			height: 4rem;
			border: 1px solid #EEE;
			border-radius: 10rem;
		}
		
		.error-circle .title {
			font-size: .7rem;
			font-weight: bold;
			margin-top: 0.8rem;
			color: #fff;
		}
		
		.error-circle .number {
			font-size: .5rem;
		}
		
		.mui-table-view:before {
			height: 0;
		}
		
		.mui-table-view:after {
			height: 0;
		}
		.own-title {
		    margin: 20px 15px 7px;
		    color: #6d6d72;
		    font-size: 15px;
		}
		
		.error-circle .number {
			font-size:.5rem;
			color: #FFF;
		}
		</style>
	</head>
	<body>
		<div class="mui-content">
			<ul class="mui-table-view" id="myexception">
				
			</ul>
			<ul class="mui-table-view" id="otherexception" style="margin-top: 10px;">
				
			</ul>
			<div class="own-title mui-hidden" id="leader-title">部门异常记录</div>
			<ul class="mui-table-view mui-grid-view mui-hidden" id="leader-content">
				
			</ul>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js?v=20160817" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			
			(function($) {
								
				var policenum = getPolicenum();
				var token = getToken();
				var myexception = document.body.querySelector('#myexception');
				var otherexception = document.body.querySelector('#otherexception');
				myexception.innerHTML = '<li class="mui-table-view-cell" id=""><a class="mui-navigate-right" href="my/main.php">我的异常记录</a></li>';
				otherexception.innerHTML = '<li class="mui-table-view-cell"><a class="mui-navigate-right" href="other/own.php?policenum='+policenum+'&token='+token+'">其它异常记录</a></li>';
				
				//部门异常统计记录
				mui.ajax(basePath+'/osapi/abnormal.php',{
					data:{
						action:'getPermissionByPolicenum',
						policenum:policenum
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							var list = data.result.data;
							var length = list.length;
							var departmentid = data.result.department;
							if(length>0){
								var leader_title = document.body.querySelector('#leader-title');
								var leader_content = document.body.querySelector('#leader-content');
								leader_title.classList.remove("mui-hidden");
								leader_content.classList.remove("mui-hidden");
								for(var i=0;i<length;i++){
									var item = list[i];
									var type = item.type;
									var color = "red"
									//colorArr 定义在common.js里面
									for(var j=0;j<colorArr.length;j++){
										if(type==colorArr[j].type){
											color = colorArr[j].color;
										}
									}
									var exceptionName = item.name.length>5?(item.name.substring(0,5)+'</br>'+item.name.substring(5,item.name.length)):item.name;
									var li = document.createElement('li');
									li.className = 'mui-table-view-cell mui-media mui-col-xs-3';
									li.innerHTML = '<a href="other/subException/index.php?type='+type+'&departmentid='+departmentid+'"><div class="error-circle" style="background-color: '+color+';">'+
												   '<p class="title">'+exceptionName+'</p><p class="number">共'+item.total+'条</p></div></a>';
									leader_content.appendChild(li);
								}
							}
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
				setTitle('异常处理'); //设置title
			})(mui);
		</script>
	</body>
</html>