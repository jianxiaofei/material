<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的评价</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<style>
			body,.mui-content{
				background-color: #fff;
			}
			.icon-xingxing{
				color: yellow;
			}
		</style>
	</head>
	<body>
		<div class="mui-content">
			<div id="slider" class="mui-slider mui-fullscreen">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" href="#item3mobile">日常评价</a>
					<a class="mui-control-item" href="#item1mobile">月评价</a>
					<a class="mui-control-item" href="#item2mobile">任务评价</a>
				</div>
				<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>
				<div class="mui-slider-group">					
					<div id="item3mobile" class="mui-slider-item mui-control-content mui-active">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>任何业绩的质变都来自于量变的积累</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header" style="background-color: #5accf3;color: #FFF;">
										日常综合评价
									</div>
									<div class="mui-card-content">
										<div class="mui-card-content-inner">
											<div class="mui-input-row">
												<label style="text-align: right;">累计星级：</label>
												<div class="icons" style="padding-top: 5px;" id="commonmain">
													
												</div>
											</div>
										</div>
									</div>
									<div class="mui-card-footer">
										<a class="mui-card-link" href="javascript:;"></a>
										<a class="mui-card-link" href="commondetail.php">查询详情</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="item1mobile" class="mui-slider-item mui-control-content">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>不积跬步无以至千里   不积小流无以成江海</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header" style="background-color: #9a89ba;color: #FFF;">
										月综合评价
									</div>
									<div class="mui-card-content">
										<div class="mui-card-content-inner">
											<div class="mui-input-row">
												<label style="text-align: right;">累计星级：</label>
												<div class="icons" style="color: #9a89ba;" id="monthmain">
													
												</div>
											</div>
										</div>
									</div>
									<div class="mui-card-footer">
										<a class="mui-card-link" href="javascript:;"></a>
										<a class="mui-card-link" style="color: #9a89ba;" href="detail.php">查看详情</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="item2mobile" class="mui-slider-item mui-control-content">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>总结成功的经验能够让人越来越聪明，总结失败的原因能够让人越来越谨慎。</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header"  style="background-color: #5bceb7;color: #FFF;">
										任务处理综合评价
									</div>
									<div class="mui-card-content">
										<div class="mui-card-content-inner">
											<div class="mui-input-row">
												<label style="text-align: right;">累计星级：</label>
												<div class="icons" style="color: #5bceb7;" id="taskmain">
													
												</div>
											</div>
										</div>
									</div>
									<div class="mui-card-footer">
										<a class="mui-card-link" href="javascript:;"></a>
										<a class="mui-card-link" style="color: #5bceb7;" href="taskdetail.php">查看详情</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
			(function($) {
				var policenum = getPolicenum();
				var token = getToken();
				//日常平均分
				mui.ajax(basePath+'/osapi/evaluation.php',{
					data:{
						action:'dailyEvaluationAvgScore',
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
							var score = data.result;
							var html = "";
							if(0==score%2){
								for(var j=0;j<score/2;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #5accf3;"></i>';
								}
							}else{
								for(var j=0;j<score/2-1;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #5accf3;"></i>';
								}
								html += '<i class="mui-icon mui-icon-starhalf" style="color: #5accf3;"></i>';
							}	
							document.getElementById('commonmain').innerHTML = html;
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
				
				mui.ajax(basePath+'/osapi/evaluation.php',{
					data:{
						action:'evaluationAvgScore',
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
							var score = data.result;
							var html = "";
							if(0==score%2){
								for(var j=0;j<score/2;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #9a89ba;"></i>';
								}
							}else{
								for(var j=0;j<score/2-1;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #9a89ba;"></i>';
								}
								html += '<i class="mui-icon mui-icon-starhalf" style="color: #9a89ba;"></i>';
							}	
							document.getElementById('monthmain').innerHTML = html;
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
				
				mui.ajax(basePath+'/osapi/task.php',{
					data:{
						action:'getMyTaskEvaluateScore',
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
							var score = data.result;
							var html = "";
							if(0==score%2){
								for(var j=0;j<score/2;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #5bceb7;"></i>';
								}
							}else{
								for(var j=0;j<score/2-1;j++){
									html += '<i class="mui-icon mui-icon-star-filled" style="color: #5bceb7;"></i>';
								}
								html += '<i class="mui-icon mui-icon-starhalf" style="color: #5bceb7;"></i>';
							}	
							document.getElementById('taskmain').innerHTML = html;
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
				
			})(mui);
			setTitle('我的综合评价'); //设置title
			
			/**
			 * 日常评价计算方法
			 * 月评价
			 * 任务评价
			 * 
			 */
		</script>
	</body>
</html>