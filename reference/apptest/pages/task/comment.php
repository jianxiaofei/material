<!--
作者：836110252@qq.com
时间：2016-07-25
业务描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>任务评价</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/feedback.css" />

	</head>

	<body class="mui-fullscreen">
		<div class="mui-content">

			<div class="row mui-input-row">
				<textarea id="textarea" rows="10"  placeholder="请输入评价内容"></textarea>
			</div>
			<div class="mui-content-padded">
				<div class="mui-inline">
					评分
				</div>
				<div class="icons mui-inline" style="margin-left: 6px;" id="div_comment">
					<i data-index="1" class="mui-icon mui-icon-star"></i>
					<i data-index="2" class="mui-icon mui-icon-star"></i>
					<i data-index="3" class="mui-icon mui-icon-star"></i>
					<i data-index="4" class="mui-icon mui-icon-star"></i>
					<i data-index="5" class="mui-icon mui-icon-star"></i>
				</div>
			</div>
			<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
				<button id="submitResponseTask" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">
				评价
				</button>
			</div>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script src="../../js/feedback2.js" charset="UTF-8"></script>
		<script>
			mui.init({
				gestureConfig: {
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
			var data_index = 0;
			var comment_result = "";
			var currentDate =getNowFormatDate()+" "+getHHMMSS();
			console.info("currentDate>>"+currentDate);

			var id =<?php echo "'". $_GET["id"] . "'" ?>;
//			var id = 1;

			(function($) {
				var parent = document.getElementById("div_comment");
				var children = parent.children;
				var index = 0;

				for(var i = 0; i < index; i++) {
					children[i].classList.add('mui-icon-star-filled');
				}

				mui("#div_comment").on("tap", "i", function() {
					data_index = this.getAttribute("data-index");
					console.info(data_index);
				});
			
				document.getElementById("submitResponseTask").addEventListener("tap", function() {
					comment_result = document.getElementById('textarea').value;
					if(null == comment_result || undefined == comment_result || "" == comment_result) {
						showWebviewToast("请输入评价内容");
						return;
					}
					if(data_index == 0) {
						showWebviewToast("请进行评分");
						return;
					}

					mui.ajax(basePath + '/osapi/appabnormal.php', {
						data: {
							action:'insettaskevalute',
							taskid: id,
							star: data_index,
							time: currentDate,
							content: comment_result
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							
							if(data.code == 200) {
								showWebviewToast("任务评价成功!");
								mui.back();
							} else {
								showWebviewToast("人物评价失败!")
							}
						},
						error: function(xhr, type, errorThrown) {
							showWebviewToast("网络异常!");
						}

					});
				});

				setTitle("任务评价");
			})(mui);
		</script>
	</body>

</html>