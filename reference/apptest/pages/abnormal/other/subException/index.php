<!--
作者：836110252@qq.com
时间：2016-05-29
描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>异常分类</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../../../../css/mui.min.css" />
		<style type="text/css">
			body {
				color: #888888;
				background-color: #fff;
			}
			
			#leader-content {
				color: #ffffff;
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
				font-size: .5rem;
				font-weight: bold;
				color: #fff;
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
				font-size: .5rem;
				color: #fff;
			}
		</style>
	</head>

	<body>
		<div class="mui-content">
			<ul class="mui-table-view mui-grid-view" id="leader-content">

			</ul>
		</div>
		<script src="../../../../js/mui.min.js"></script>
		<script src="../../../../js/common.js?v=20160808" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			(function($) {
				var department = <?php echo "'". $_GET["departmentid"] . "'" ?>;
				var type = <?php echo "'". $_GET["type"] . "'" ?>;
				var token = getToken();
				mui.ajax(basePath + '/osapi/abnormal.php', {
					data: {
						action: 'getAbnormalTotalBytypeAndDepartment',
						departmentid: department,
						parentid: type
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'GET', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if("200" == data.code) {
							var list = data.result;
							var length = list.length;
							var leader_content = document.body.querySelector('#leader-content');
							for(var i = 0; i < length; i++) {
								var d = list[i];
								var count = d.total;
								var color = "red";

								//colorArr 定义在common.js里面
								for(var j = 0; j < colorArr.length; j++) {
									if(d.type == colorArr[j].type) {
										color = colorArr[j].color;
									}
								}
								var exceptionName = d.name.length > 5 ? (d.name.substring(0, 5) + '</br>' + d.name.substring(5, d.name.length)) : d.name;
								var lineheight = 0;
								if(d.name.length > 5) {
									lineheight = "0.8rem";
								} else {
									lineheight = "1.2rem";
								}
								if(d.isParent) {
									var li = document.createElement('li');
									li.className = 'mui-table-view-cell mui-media mui-col-xs-3';
									li.innerHTML = '<a href="index.php?type=' + d.type + '&departmentid=' + department + '"><div class="error-circle" style="background-color: ' + color + ';">' +
										'<p class="title" style="line-height:0.8rem;">' + exceptionName + '</p><p class="number">共' + count + '条</p></div></a>';
									leader_content.appendChild(li);
								} else {
									var li = document.createElement('li');
									li.className = 'mui-table-view-cell mui-media mui-col-xs-3';
									if(d.isParentDep) {
										li.innerHTML = '<a data-key="' + d.type + '" data-data="' + d.isParentDep + '" href="department.php?type=' + d.type + '&department=' + department + '"><div class="error-circle" style="background-color: ' + color + ';">' +
											'<p class="title" style="line-height:0.8rem;">' + exceptionName + '</p><p class="number">共' + count + '条</p></div></a>';
										leader_content.appendChild(li);
									} else {
										li.innerHTML = '<a data-key="' + d.type + '" data-data="' + d.isParentDep + '" href="../list.php?type=' + d.type + '&department=' + department + '"><div class="error-circle" style="background-color: ' + color + ';">' +
											'<p class="title" style="line-height:' + lineheight + '">' + exceptionName + '</p><p class="number">共' + count + '条</p></div></a>';
										leader_content.appendChild(li);
									}

								}

							}
						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast('网络异常!');
					}
				});

				//				mui("#leader-content").on("tap","a",function(){
				//					var type = this.getAttribute('data-key');
				//					var isParentDep = this.getAttribute('data-data');
				//					if(isParentDep=="true"){
				//						window.location.href = "department.php?type="+type+"&department="+department;
				//					}else{
				//						window.location.href = "../list.php?type="+type+"&department="+department;
				//					}
				//				});

				setTitle('异常分类统计'); //设置title
			})(mui);
		</script>
	</body>

</html>