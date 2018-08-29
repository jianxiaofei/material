<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>考勤管理</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../../css/mui.min.css">
		<link rel="stylesheet" href="../../../css/iconfont.css"/>
		<style>
			.title {
				margin: 20px 15px 7px;
				color: #6d6d72;
				font-size: 15px;
			}
			
			.mui-bar {
				background-color: #196fc6;
			}
			
			.mui-content {
				background-color: #fafafa;
				color:#888888;
			}
			
			.mui-navigate-right img, .mui-navigate-right span {
				float: left;
			}
			
			.mui-navigate-right img {
				width: 6%;
			}
			
			.mui-navigate-right span {
				margin-left: 5%;
			}
			
			.mui-navigate-right:after, .mui-push-left:after, .mui-push-right:after {
				top:46%
			}
			
			.mui-title {
				color:#ffffff;
			}
			
			.mui-table-view:before ,.mui-table-view:after{
				background-color: #ffffff;
			}

			.mui-media-body {
				color:#888888;
			}

			.mui-media-body span {
				font-size: .6rem;
				color:#888888;
			}

			.mui-media-body p {
				font-size: .6rem;
				margin-top: 1%;
				color:#888888;
			}

			.times {
				float: right;
				margin-right: 5%;
			}

			.stars {
				position: absolute;
				left:80%;
				top:39%;
			}

			.mui-table-view .mui-media-object {
				max-width: 70px;
				height: 70px;

			}

			.mui-table-view {
				font-size: 14px;!important;
			}
			
			.mui-media-object {
				border-radius:50%;
			}
			.mui-icon{
				font-size: .8rem;
			}
			.icon-xingxing{
				color: yellow;
			}
			.iconfont{
				font-size: 1.2rem;
			}
		</style>
	</head>
	<body>
		
			<br />
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="mineAttendanceList">
						<span class="mui-icon iconfont datatom-icon-wodemingxi" style="color:#76e799;"></span>
						<span> 考勤自动提交</span>
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="mineExceptionList">
						<span class="mui-icon iconfont datatom-icon-wodeyichang" style="color: #f770df;"></span>
						<span> 考勤手动申请</span>

					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="myApply">
						<span class="mui-icon iconfont datatom-icon-wodeshenqing" style="color: #6ecefe;"></span>
						<span> 工作日志异常</span>
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="javascript:;" id="myApprove">
						<span class="mui-icon iconfont datatom-icon-wodeshenpi" style="color: #c1e784;"></span>
						<span> 辅警请假审批</span>

					</a>
				</li>
			</ul>
			<br />
			
		</div>
	</body>
	<script src="../../../js/mui.min.js"></script>
	<script src="../../../js/common.js" charset="UTF-8"></script>
	<script>
	
		mui.init();
		(function($) {
			var policenum = getPolicenum();
			var token = getToken();
			mui.ajax(basePath+'/osapi/attendance.php',{
				data:{
					action:'getAttendanceManagement',
					policenum:policenum
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'GET',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if("200"==data.code){
						var message = data.result;
						var img = mui('.mui-media-object');
						img[0].src = basePath+'/osapi/avantar.php?policenum='+policenum;
						document.getElementById('zrkq').innerHTML = message.attendanceStatus.attendance;
						document.getElementById('zrjb').innerHTML = message.attendanceStatus.overtime;
						var xingxing = "";
						for(var i=0;i<message.creditInfo.attcredit;i++){
							xingxing += '<i class="mui-icon mui-icon-star-filled icon-xingxing"></i>';
						} 
						document.getElementById('icons').innerHTML = xingxing;
						if(0==message.appabnorInfo.workabnornal){
							document.getElementById("wdyc").classList.add("mui-hidden");
							document.getElementById("wdyc").innerHTML = message.appabnorInfo.workabnornal;
						}else{
							document.getElementById("wdyc").innerHTML = message.appabnorInfo.workabnornal;
						}
						if(0==message.appabnorInfo.myapproval){
							document.getElementById("wdsp").classList.add("mui-hidden");
							document.getElementById("wdsp").innerHTML = message.appabnorInfo.myapproval;
						}else{
							document.getElementById("wdsp").innerHTML = message.appabnorInfo.myapproval;
						}
						if(0==message.appabnorInfo.tempschedule){
							document.getElementById("lspb").classList.add("mui-hidden");
							document.getElementById("lspb").innerHTML = message.appabnorInfo.tempschedule;
						}else{
							document.getElementById("lspb").innerHTML = message.appabnorInfo.tempschedule;
						}
//						showWebviewToast("message>>"+JSON.stringify(message));
					}else{
						mui.alert(data.msg, '警告信息');
					}
				},
				error:function(xhr,type,errorThrown){
					mui.alert('请求失败！请检查网络是否异常!', '警告信息');
				}
			});		
			//考勤自动提交
			document.getElementById('mineAttendanceList').addEventListener("tap",function(){
				window.javaInterface.startDefaultHtmlActivity(basePath+"/extapp/app/html5/attendance/fujing/list/audioApplyList.php");
			});
			//考勤手动申请
			document.getElementById('mineExceptionList').addEventListener("tap",function(){
				window.javaInterface.startDefaultHtmlActivity(basePath+"/extapp/app/html5/attendance/fujing/list/audioNoApplyList.php");
			});
			//工作日志异常
			document.getElementById('myApply').addEventListener("tap",function(){
				window.javaInterface.startDefaultHtmlActivity(basePath+"/extapp/app/html5/attendance/fujing/list/workLogList.php");
			});
			//辅警请假审批
			document.getElementById('myApprove').addEventListener("tap",function(){
				window.javaInterface.startDefaultHtmlActivity(basePath+"/extapp/app/html5/attendance/fujing/list/needApplyList.php");
			});
			
	
			setTitle('辅警考勤管理');
		})(mui);
	</script>

</html>