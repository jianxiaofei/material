<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的考勤</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../../css/mui.min.css">
	<style>
		body,.mui-content{
			background-color: #f5f6f8;
		}
		.mui-table-view {
			margin-top: 0;
		    padding: 2% 3%;
		    background-color: #f5f6f8;
		}		
		.mui-table-view:after,.mui-table-view:before{
			background-color: #f5f6f8;
		}
		.mui-table-view-cell {
			padding-top: .45rem;
			padding-bottom: .45rem;
		    box-shadow: 3px 3px #eeeff2;
		    background-color: #ffffff;
		    margin: 4% 0;
		}
		.mui-table-view-cell:after{
			background-color: #FFF;
		}
		.square{
			color: #FFF;
			width: 3rem;
			line-height: 3rem;
			font-size: .6rem;
		    height: 3rem;
		    display: inline-block;
		    text-align: center;
		    border-radius: 50%;
		    background-clip: padding-box;
		}
		.square-color-1{
			background-color: #8fe294;
		}
		.square-color-2{
			background-color: #c3e380;
		}
		.square-color-3{
			background-color: #fbd06a;
		}
		.square-color-4{
			background-color: #fd0002;
		}
		.title{
			display: inline-block;
			line-height: 3rem;
			height: 3rem;
			margin-left: 1rem;
			color: #888;
			font-size: .8rem;
		}
		.mui-table-view li:first-child {
		    margin: 0 0;
		}
		/**
		 * 正常
		 */
		.status-normal{
			background-color: #23AE37;
		}
		/**
		 * 请假
		 */
		.status-leave{
			background-color: #0074DE;
		}
		/**
		 * 旷工
		 */
		.status-absenteeism{
			background-color: #E60111;
		}
		/**
		 * 异常
		 */
		.status-exception{
			background-color: #E86A47;
		}
		/**
		 * 迟到
		 */
		.status-late{
			background-color: #EA6A76;
		}
		/**
		 * 早退
		 */
		.status-leaveearly{
			background-color: #EA6A71;
		}
		/**
		 * 假期
		 */
		.status-vacation{
			background-color: #53D47D;
		}
		/**
		 * 其他
		 */
		.status-other{
			background-color: #8f8f8f;
		}
		
		/**
		 * 系统
		 */
		.fcolor-1{
			background-color: #1CB32D;
		}
		/**
		 * 上级
		 */
		.fcolor-2{
			background-color: #EFB935;
		}
		/**
		 * 信用
		 */
		.fcolor-3{
			background-color: #53D47D;
		}
		/**
		 * 个人
		 */
		.fcolor-4{
			background-color: #E86A47;
		}
	</style>
</head>
<body>
<div class="mui-content">
	<ul class="mui-table-view" id="list-attendance">
		
	</ul>
</div>
<script src="../../../js/mui.min.js" charset="UTF-8"></script>
<script src="../../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init();
	var condition = getNowFormatDate();
	var policenum = getPolicenum();
	var realname=getRealname();
	var token = getToken();
	function callByAndroid(json){
		var arr = eval("(" + json + ")");
		condition = arr.date;
		getList();
	}
	
	function getList(){
		mui.ajax(basePath+'/osapi/attendance.php',{
			data:{
				action:'getHistoryList',
				policenum:policenum,
				year:condition.substring(0,4),
				month:condition.substring(5,7)
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
					var length = message.length;
					var ul = document.body.querySelector(".mui-table-view");
					ul.innerHTML = "";
					var fragment = document.createDocumentFragment();
					mui.each(message,function(index,item){
						var date_status = item.date_status;
						var type = "暂无";
						var tcolor = "status-normal";
						if(1==date_status){
							type = "正常";
							tcolor = "status-normal";
							if(1==item.ask_for_leave){
								type = item.leavetypestr;
								tcolor = "status-leave";
							}else if(1==item.holiday||2==item.holiday){
								type = "休息";
								tcolor = "status-vacation";
							}else if(0==item.error){
								type = "正常";
							}else{
								var d1 = new Date();
								var d2 = new Date(item.time);
								var days=Math.floor((d1.getTime()-d2.getTime())/(24*3600*1000));
								if(days<3){
									type = "异常";
									tcolor = "status-exception";
								}else{
									if (item.absenteeism == 1)
										type = "旷工";
										tcolor = "status-absenteeism";
					
									if (item.late == 1) {
										type = "迟到";
										tcolor = "status-late";
									}
					
									if (item.leaveearly == 1) {
										type = "早退";
										tcolor = "status-leaveearly";
									}
								}
							}
						}else{
							type = "辞职";
							tcolor = "status-other";
							if(item.date_status == 2)
							   type = "辞职";
							if(this.date_status == 3)
								type = "退休";
							if(this.date_status == 4)
								type = "开除";
							if(this.date_status == 5)
								type = "辞退";
							if(this.date_status == 6)
								type = "借调";
							if(this.date_status == 7)
								type = "工伤久病";
							if(this.date_status == 8)
								type = "局外借调";
							if(this.date_status == 9)
								type = "社区民警";
							if(this.date_status == 10)
								type = "其他人员";
						}
						
						var from = "系统";
						var fcolor = "fcolor-1";
						if(1==item.error_sign){
							from = "上级";
							fcolor = "fcolor-2";
						}
						if(3==item.error_sign){
							from = "个人";
							fcolor = "fcolor-4";
						}
						if(1==item.credit_sign){
							from = "信用";
							fcolor = "fcolor-3";
						}
						
						var li = document.createElement('li');
						li.className = "mui-table-view-cell";
						li.innerHTML = '<a href="javascript:void(0);" class="mui-navigate-right detail" data-policenum="'+policenum+'" data-data="'+item.date+'"><span class="square '+tcolor+'">'+type+'</span>'
									  +'<span class="title">'+item.date.substring(5,10)+'('+item.week+')</span>'
									  +'<span class="mui-badge '+fcolor+'">'+from+'</span></a>';
						fragment.appendChild(li);
					});
					ul.appendChild(fragment);
				}else{
					showWebviewToast(data.msg);
				}
			},
			error:function(xhr,type,errorThrown){
				showWebviewToast('网络异常!');
			}
		});
	}
	
	(function($) {
		getList();	
				
		mui("#list-attendance").on("tap","a.detail",function(){
			//获取id
			var id = this.getAttribute("data-data");
			var data_policenum=this.getAttribute("data-policenum");
			window.javaInterface.startDefaultHtmlActivity(basePath+"/extapp/app/html5/attendance/mine/detail.php?date="+id+"&data-policenum="+data_policenum);
		});
		
		setTitle(realname+"的考勤列表");
	})(mui);
</script>
</body>
</html>