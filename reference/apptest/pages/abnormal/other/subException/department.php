<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>部门异常统计</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../../../../css/mui.min.css" />		
		<style type="text/css">
		body {
			color:#888888;
			background-color: #fff;
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
		}
		</style>
	</head>

	<body>
		<div class="mui-content" >
			<ul class="mui-table-view" id="leader-content">
				
			</ul>
		</div>
		<script src="../../../../js/mui.min.js"></script>
		<script src="../../../../js/common.js" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			(function($) {
				var department = <?php echo "'". $_GET["department"] . "'" ?>;
				var type = <?php echo "'". $_GET["type"] . "'" ?>;
				var token = getToken(); 
				mui.ajax(basePath+'/osapi/abnormal.php',{
					data:{
						action:'getDeparmentAbnormalTotalByType',
						department:department,
						type:type
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'GET',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							var list = data.result;
							list.sort(function(a,b){
            					return b.total-a.total});
							var length = list.length;
							var leader_content = document.body.querySelector('#leader-content');
							for(var i=0;i<length;i++){
								var d = list[i];
								var count = d.total;
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell';
								li.innerHTML = '<a href="../list.php?type='+type+'&department='+d.departmentid+'" class="mui-navigate-right" style="color:#888;">'+d.name+'<span class="mui-badge" style="background-color:#fbbfe6;color:#fff;">'+d.total+'</span></a>';
								leader_content.appendChild(li);
							}
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
				setTitle('部门异常统计');  //设置title
			})(mui);
		</script>
	</body>

</html>