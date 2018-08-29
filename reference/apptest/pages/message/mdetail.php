<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>消息中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	<style>
		html,body,.mui-content{
			background-color: #FFF;
		}
	</style>
</head>
<body>
	<div class="mui-content">
		<div class="mui-content-padded">
			
		</div>
	</div>
</div>
<script src="../../js/mui.min.js"></script>
<script src="../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init({
		swipeBack: false
	});
	(function ($) {
		var policenum = <?php echo "'". $_GET["policenum"] . "'" ?>;
		var token = <?php echo "'". $_GET["token"] . "'" ?>;
		var id = <?php echo "'". $_GET["id"] . "'" ?>;
		mui.ajax(basePath+'/osapi/message.php',{
			data:{
				action:'getMessageDetails',
				policenum:policenum,
				id:id
			},
			beforeSend: function(request) {
                request.setRequestHeader("U-Auth-Token", token);
            },
			dataType:'json',//服务器返回json格式数据
			type:'POST',//HTTP请求类型
			timeout:10000,//超时时间设置为10秒；
			success:function(data){
				if(data.code=="200"){
					if(null==data.result.messagebody.text&&""==data.result.messagebody.text||undefined==data.result.messagebody.text){
						document.body.querySelector('.mui-content-padded').innerHTML = "暂无详情";
					}else{
						var text = data.result.messagebody.text;
						document.body.querySelector('.mui-content-padded').innerHTML = text;
					}
					
				}else{							
					window.javaInterface.showWebviewToast(data.msg);
				}
			},
			error:function(xhr,type,errorThrown){
				window.javaInterface.showWebviewToast('网络异常!');
			}
		});
		
		window.javaInterface.setTitle('详情'); //设置title
	})(mui);
</script>
</body>
</html>