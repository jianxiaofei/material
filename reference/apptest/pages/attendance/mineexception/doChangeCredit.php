<!--
	作者：836110252@qq.com
	时间：2016-05-29
	模块名称：异常信用修改
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>异常信用修改</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../../css/mui.min.css">
	<style>
		.mui-row label{
			padding-right: 20px;
			color: #8f8f94;
			font-size: 14px;
		}
		.mui-row p{
			margin: 0;
		}
		.mui-row select{
			margin: 0;
			padding: 0;
			border: 1px solid rgba(0,0,0,.2) !important;
    		border-radius: 3px;
		}
		.mui-col-sm-3{
			text-align: right;
		}
		.icon-xingxing{
			color: yellow;
		}
		.icon-xingxing-normal{
			color: #fff;
		}
	</style>
</head>
<body class="mui-fullscreen">
	<div id="pullrefresh" class="mui-content mui-scroll-wrapper">
		<div class="mui-scroll" id="listAtt">
			<div class="mui-card">
				<div class="mui-input-row mui-radio mui-hidden" id="late">
						<label>迟到(1分)</label>
						<input name="radio" type="radio" value="0">
					</div>
					<div class="mui-input-row mui-radio mui-hidden" id="leaveearly">
						<label>早退(1分)</label>
						<input name="radio" type="radio" value="1">
					</div>
					<div class="mui-input-row mui-radio mui-hidden" id="absenteeismhalf">
						<label>旷工半天(5分)</label>
						<input name="radio" type="radio" value="2">
					</div>
					<div class="mui-input-row mui-radio mui-hidden" id="absenteeism">
						<label>旷工一天(10分)</label>
						<input name="radio" type="radio" value="3">
					</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>异常日期：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8">
						<p id="alias"></p>
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>信用等级：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8" id="attcredit">
						
					</div>
				</div>
			</div>
			<div class="mui-content-padded">
				<div class="mui-row">
					<div class="mui-col-sm-3 mui-col-xs-4">
						<label>信用总分：</label>
					</div>
					<div class="mui-col-sm-9 mui-col-xs-8" id="creditscore">
						
					</div>
				</div>
			</div>
			<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
				<button id="submitApply" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
			</div>
		</div>
	</div>
<script src="../../../js/mui.min.js" charset="UTF-8"></script>
<script src="../../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init();
	mui('.mui-scroll-wrapper').scroll();
	var alias = <?php echo "'". $_GET["alias"] . "'" ?>;
	var late = <?php echo "'". $_GET["late"] . "'" ?>;
	var leaveearly = <?php echo "'". $_GET["leaveearly"] . "'" ?>;
	var absenteeism = <?php echo "'". $_GET["absenteeism"] . "'" ?>;
	var date = <?php echo "'". $_GET["date"] . "'" ?>;
	var policenum = getPolicenum();
	var token = getToken();
	var score = 0;
	
	function getData(){
		mui.ajax(basePath+'/osapi/credit.php',{
			data:{
				action:"getCreditInfo",
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
					var html = "";
					for(var i=0;i<data.result.attcredit;i++){
						html += '<i class="mui-icon icon-xingxing mui-icon-star-filled"></i>';
					}
					for(var i=5;i>data.result.attcredit;i--){
						html += '<i class="mui-icon icon-xingxing-normal mui-icon-star-filled"></i>';
					}
					document.getElementById('attcredit').innerHTML = html;
					document.getElementById('creditscore').innerHTML = data.result.creditscore;
					score = data.result.creditscore;
				}else{
					showWebviewToast(data.msg);
				}
			},
			error:function(xhr,type,errorThrown){
				showWebviewToast("网络异常");
			}
		});
	}
	
	(function($) {		
		
		if(late=="1"){
			document.getElementById('late').classList.remove("mui-hidden");
		}
		if(leaveearly=="1"){
			document.getElementById('leaveearly').classList.remove("mui-hidden");
		}
		if(absenteeism=="1"){
			document.getElementById('absenteeismhalf').classList.remove("mui-hidden");
		}else if(absenteeism=="2"){
			document.getElementById('absenteeismhalf').classList.remove("mui-hidden");
			document.getElementById('absenteeism').classList.remove("mui-hidden");
		}
		
		document.getElementById('alias').innerHTML = alias;
		
		getData();
		
		document.getElementById('submitApply').addEventListener("tap",function(){
			var type = "";
			if(null!=document.querySelector('[name="radio"]:checked')){
				type = document.querySelector('[name="radio"]:checked').value;
			}
			
			if(null==type||""==type||undefined==type){
				showWebviewToast("请选择信用修改类型!");
				return;
			}
			var action = "";
			var time = "";
			if(type=="0"){
				if(score<1){
					showWebviewToast("信用积分不足，无法修改信用");
					return;
				}
				action = "modifyLateByOneself";				
			}else if(type=="1"){
				if(score<1){
					showWebviewToast("信用积分不足，无法修改信用");
					return;
				}
				action = "modifyLeaveearlyByOneself";
			}else if(type=="2"){
				if(score<5){
					showWebviewToast("信用积分不足，无法修改信用");
					return;
				}
				action = "modifyAbsenteeismByOneself";
				if(absenteeism=="1"){
					time = "0";
				}else{
					time = "0.5";
				}
			}else if("3"==type){
				if(score<10){
					showWebviewToast("信用积分不足，无法修改信用");
					return;
				}
				action = "modifyAbsenteeismByOneself";
				time = "0";
				
			}
			
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:action,
					policenum:policenum,
					date:date,
					time:time
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if("CODE_ERROR"!=data.code){
						window.javaInterface.startDatePickHtmlActivity(basePath+'/extapp/app/html5/attendance/mineexception/index.php');
						showWebviewToast("异常信用修改成功!");
					}else{
						showWebviewToast("信用积分不足，无法修改信用");
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		});
		
		setTitle("异常信用修改");
	})(mui);
	
</script>
</body>
</html>