<!--
	作者：836110252@qq.com
	时间：2016-07-25
	业务描述：
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>任务回复</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" href="../../css/mui.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/feedback.css" />

</head>
<body class="mui-fullscreen">
	<div class="mui-content">
		<div class="mui-row" id="peopleDom" style="background-color: #fff;margin-bottom: 5px;margin-top: 5px;">
			<!--<div class="mui-input-row mui-checkbox mui-left">
				<label>checked：false</label>
				<input name="checkbox" value="Item 1" type="radio">
			</div>-->
		</div>
		<div class="row mui-input-row">
			<textarea id="content" rows="10" class="mui-input-clear content" placeholder="请输入回复内容"></textarea>
		</div>	
		<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
			<button id="submitResponseTask" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
		</div>
	</div>
<script src="../../js/mui.min.js" charset="UTF-8"></script>
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
				
	var token = getToken();
	var policenum = getPolicenum();
	var realname = getRealname();
	var id = <?php echo "'". $_GET["id"] . "'" ?>;
	var task = "";
	var pinfo = <?php echo "'". $_GET["pinfo"] . "'" ?>;
	var taskName = <?php echo "'". $_GET["taskName"] . "'" ?>;
	
	
	(function($) {		
		var arr = eval("(" + pinfo + ")");
		var peopleDom = document.getElementById('peopleDom');
		var htm = "";
		mui.each(arr,function(index,item){
			if(policenum!=item.policenum){
				htm += '<div class="mui-input-row mui-radio mui-left">';
				htm += '<label>'+item.realname+'('+item.policenum+')</label>';
				htm += '<input name="checkbox" value="'+item.policenum+'" type="radio"></div>';
			}
		});
		peopleDom.innerHTML = htm;
		//查询任务基础信息
		getTaskDetail(id);
		
		//
		document.getElementById("submitResponseTask").addEventListener("tap",function(){
			var content = document.getElementById("content").value;
			var person = null;
			if(null!=document.querySelector('[name="checkbox"]:checked')){
				person = document.querySelector('[name="checkbox"]:checked').value;
			}
			if(null==person||undefined==person||""==person){
				showWebviewToast("请选择回复人");
                return;
			}
			if(null==content||undefined==content||""==content){
				showWebviewToast("请填写回复内容");
                return;
			}
			var body = {}
			var msg = {};
			msg.comment=content;
			msg.fromPoliceName = realname;
			msg.fromPoliceNum = policenum;
			var logtime = getNowFormatDate()+" "+getHHMMSS();
			msg.logtime = logtime.substring(0,16);
			msg.toPoliceNum = person;
			body.msg = msg;
			body.taskid = id;
			//{"msg":{"comment":"留言测试","fromPoliceName":"测试2三贵","fromPoliceNum":"666666","logtime":"2016-08-18 16:13","toPoliceNum":"777777"},"taskid":"3454117a64ec4301824b6c40f8c66b45"}
			mui.ajax(basePath+'/apps/task/addTaskMsg',{
				data:JSON.stringify(body),
				beforeSend: function(request) {
					request.setRequestHeader("Content-Type", "application/json");
					request.setRequestHeader("U-Auth-Token",token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					var msg = realname+'在《'+taskName+'》中给你留言:'+content;
					mui.ajax(basePath+'/osapi/task.php',{
						data:{
							action:"SMSNotice",
							message:msg,
							policenum:person
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'POST',//HTTP请求类型
						timeout:10000,//超时时间设置为10秒；
						success:function(data){
							//showWebviewToast("短信发送成功!");
						}
					});
					window.location.reload();
					showWebviewToast("回复成功");
				}
			});
		});
		
		function getTaskDetail(key){
			mui.ajax(basePath+'/osapi/task.php',{
				data:{
					action:"getTaskDetail",
					taskid:id
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						task = data.result;
					}else{
						showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		}
		
		setTitle("任务回复");
	})(mui);
</script>
</body>
</html>