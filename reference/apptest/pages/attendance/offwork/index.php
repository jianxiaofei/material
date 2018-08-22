<!--
	作者：836110252@qq.com
	时间：2016-05-29
	业务逻辑描述：1、病假三天以上(包含三天)显示上传附件按钮，必须上传附件
				 2、开始时间不能小于当前时间     
				 	一天之内下午不能请上午的假 
				 	上午可以请上午的假 
				 	下午可以请下午的假 
				 	上午可以请下午
				 3、请假不能重叠(后端接口判断
				 4、请假截止时间必须大于开始时间
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>请销假</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css"/>
		<link rel="stylesheet" href="../../../css/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="../../../css/mui.picker.min.css"/>
		<style>
			.mui-input-row label{
				font-size: 1rem;
			}
			.mui-input-row select,.mui-input-row input{
				font-size: .9rem;
			}
			.mui-input-row select{
				direction: rtl;
			}
			.mui-input-row select option{
				direction: ltr;
			}
			.mui-input-row input{
				margin-bottom: 0;
			    border: 0;
			    border-radius: 0;
			    background-color: transparent;
			    -webkit-box-shadow: none;
			    box-shadow: none;
			    text-align: right;
			}
			.image-item.space {
			    border: none;
			}
			.image-item {
				width: 65px;
				height: 65px;
				background-image: url(../../../img/iconfont-tianjia.png);
				background-size: 100% 100%;
				display: inline-block;
				position: relative;
				border-radius: 5px;
				margin-right: 10px;
				margin-bottom: 10px;
				border: solid 1px #e8e8e8;
			}
			.image-item.space {
				border: none;
			}
			.image-item .image-close {
				position: absolute;
				display: inline-block;
				right: -6px;
				top: -6px;
				width: 20px;
				height: 20px;
				text-align: center;
				line-height: 20px;
				border-radius: 12px;
				background-color: #FF5053;
				color: #f3f3f3;
				border: solid 1px #FF5053;
				font-size: 9px;
				font-weight: 200;
				z-index: 1;
			}
			.image-item.space .image-close {
				display: none;
			}
			.mui-table-view .mui-active,.mui-table-view .mui-table-view-cell a.mui-active{
				background-color: #FFF;!important
			}
			.attachment-list img{
				width: 20px !important;
				height: 20px !important;
				line-height: 20px !important;
			}
			.leaveDay:after{
				visibility: hidden;
			}
		</style>
	</head>
	<body>
		<div class="mui-content mui-scroll-wrapper mui-fullscreen" style="padding-top: 10px;padding-bottom: 10px;">
			<div class="mui-scroll">
				<ul class="mui-table-view">
					<li class="mui-table-view-cell" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>请假类型</label>
							<select class="mui-btn mui-btn-block" id="reason" name="reason" style="width: 65%;padding-left: 30%;padding-right: 0;">
									<option value="0" class="mui-navigate-right">请选择(必填)</option>
									<option value="公休">公休</option>
									<option value="探亲">探亲</option>
									<option value="婚丧">婚丧</option>
									<option value="产假">产假</option>
									<option value="陪护">陪护</option>
									<option value="学习培训">学习培训</option>
									<option value="因公出差">因公出差</option>
									<option value="对外联络">对外联络</option>
									<option value="假期备案">假期备案</option>
									<option value="陪护">陪护</option>
									<option value="事假">事假</option>
									<option value="病假">病假</option>
									<option value="工伤特假">工伤特假</option>
									<option value="支取时间银行">支取时间银行</option>
								</select>
						</div>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 15px;">
					<li class="mui-table-view-cell datatom-date" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>开始时间</label>
							<div class="mui-navigate-right">
								<button id="startBtn" data-key="start" style="font-size: .9rem;width:45%;border: 0;line-height: 1;text-align: right;padding-right: 0;"
									  class="btn mui-btn mui-btn-block">请选择时间</button>
								<input class="mui-input" id='qjstart' type="hidden" value=""/>
							</div>
						</div>
					</li>
					<li class="mui-table-view-cell datatom-date" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>结束时间</label>
							<div class="mui-navigate-right">
								<button id="endBtn" data-key="end" style="font-size: .9rem;width:45%;border: 0;line-height: 1;text-align: right;padding-right: 0;" class="btn mui-btn mui-btn-block">请选择时间</button>
								<input id='qjend' type="hidden" value=""/>
							</div>
						</div>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 15px;">
					<li class="mui-table-view-cell" style="padding:0;">
						<div class="mui-input-row mui-navigate-right leaveDay">
							<label>请假天数</label>
							<input id="qjdays" class="btn mui-btn mui-btn-block" type="text" value="0" disabled="disabled" style="width: 65%;padding-right: 0;"/>
						</div>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 15px;">
					<li class="mui-table-view-cell" style="padding:0;">
						<div class="mui-input-row">
							<label>请假事由</label>
							<textarea id="qjtextarea" cols="*" rows="5" placeholder="请输入请假事由(必填)"></textarea>
						</div>
					</li>
				</ul>
				<ul class="mui-table-view" style="margin-top: 15px;">
					<li class="mui-table-view-cell" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>活动范围</label>
							<select id="qjarea" class="mui-btn mui-btn-block" name="area" style="width: 65%;padding-left: 30%;padding-right: 0;">
									<option value="0" class="mui-navigate-right">请选择(选填)</option>
									<option value="1">离开本市</option>
									<option value="2">出国出境</option>
								</select>
						</div>
					</li>
				</ul>
				<div class="mui-input-row" style="padding:10px;">
					<a href="leaverule.html" class="mui-icon mui-icon-info-filled mui-pull-right" style="color: #888;font-size: .8rem;">查看请假规定</a>
				</div>
				<ul class="mui-table-view">
					<li class="mui-table-view-cell" style="padding:0;" id="selectFile">
						<div class="mui-input-row">
							<label style="color: #888;">选择附件</label>
							<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment" style="padding: 11px 15px;color: #888;"></span>
						</div>
					</li>
				</ul>
				<ul id="attachment-list" class="mui-table-view"><!--
					<li class="mui-table-view-cell mui-media">
						<a class="attachment-list">
							<img class="mui-media-object mui-pull-left" src="../../img/txt.png"/>
							<div class="mui-media-body">123<p class="mui-pull-right"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete"></span></p>
							</div>
						</a>
					</li>-->
				</ul>
				<div class="mui-button-row" style="margin-top: 20px;">
					<button id="submitQXJ" type="button" class="mui-btn" style="width: 90%;height: 46px;background-color: #003b79;color: #fff;">提交</button>
				</div>
			</div>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/mui.picker.min.js"></script>
		<script src="../../../js/common.js"></script>
		<script>
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
			//获取警员编号
			var policenum = getPolicenum();
			//获取登录token
			var token = getToken();
			var levelid = getLevelid();
			//时间银行
			var timebank = -999999;
			
			var attachments = [];
			
			function getTimeBank(){
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getOvertimSum',
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
							//向下取整
							timebank = Math.floor(data.result.overtime_sum/3600);
						}else{
							showWebviewToast(data.msg);
						}
					},
					error:function(xhr,type,errorThrown){
						showWebviewToast("网络异常!");
					}
				});
			}
			
			//删除附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-list").on("tap","span.deleteAttachment",function(){
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				var key = this.getAttribute("data-key");
				var arr = [];
				mui.each(attachments,function(index,item){
					if(item.id!=key){
						arr.push(item);
					}
				});
				attachments = arr;
			});
			
			function callByAndroid(json){
				var arr = eval("(" + json + ")");
				var files = arr.files;
				var parentId="attachment-list";
				attachments = files;
				var length = files.length;
				for(var i=0;i<length;i++){
					var item = files[i];
					var fname = item.name;	
					var li = document.createElement('li');
					li.className = "mui-table-view-cell mui-media";
					li.innerHTML += '<a class="attachment-list">'
					+ '<img class="mui-media-object mui-pull-left" src="../../../img/txt.png"/>'
					+ '<div class="mui-media-body">'+fname.substring(fname.length-20,fname.length)+'<p class="mui-pull-right" style="padding:0px;"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="'+item.id+'"></span></p>'
					+ '</div></a>';
					document.getElementById(parentId).appendChild(li);
				}
			}
			
			(function($) {
				//获取时间银行
				getTimeBank();
				var btns = $('.btn');
				btns.each(function(i, btn) {
					btn.addEventListener('tap', function() {
						var key = this.getAttribute('data-key');
						var that = this;
						var customData = '{"h":[{"text":"上午","value":"上午"},{"text":"下午","value":"下午"}]}';
						var syear = parseInt(getNowYear());getNowDate
						var eyear = parseInt(getNowYear())+10;
						var optionsJson = '{"type":"hour","beginDay":'+getNowDate()+',"beginMonth":'+getNowMonth()
						+',"beginYear":'+syear+',"endYear":'
						+eyear+',"customData":'+customData+',"labels":["年", "月", "日", "时段"]}';
						var options = JSON.parse(optionsJson);
						/*
						 * 首次显示时实例化组件
						 * 示例为了简洁，将 options 放在了按钮的 dom 上
						 * 也可以直接通过代码声明 optinos 用于实例化 DtPicker
						 */
						var picker = new $.DtPicker(options);
						picker.show(function(rs) {
							/*
							 * rs.value 拼合后的 value
							 * rs.text 拼合后的 text
							 * rs.y 年，可以通过 rs.y.vaue 和 rs.y.text 获取值和文本
							 * rs.m 月，用法同年
							 * rs.d 日，用法同年
							 * rs.h 时，用法同年
							 * rs.i 分（minutes 的第二个字母），用法同年
							 */
							var isPM = rs.text.substring(11,14);
							if("start"==key){
								
								that.innerHTML = rs.text+"开始";
								
								if("上午"==isPM){
									document.getElementById('qjstart').value = rs.text.substring(0,10)+" " + "00:00";
									var input = document.getElementById('qjstart');
									mui.trigger(input,'change');
								}else{
									document.getElementById('qjstart').value = rs.text.substring(0,10)+" " + "13:00";
									var input = document.getElementById('qjstart');
									mui.trigger(input,'change');
								}
							}else{
								
								that.innerHTML = rs.text+"结束";
								
								if("上午"==isPM){
									document.getElementById('qjend').value = rs.text.substring(0,10)+" " + "12:59";
									var input = document.getElementById('qjend');
									mui.trigger(input,'change');
								}else{
									document.getElementById('qjend').value = rs.text.substring(0,10)+" " + "23:59";
									var input = document.getElementById('qjend');
									mui.trigger(input,'change');
								}
							}
							
							/* 
							 * 返回 false 可以阻止选择框的关闭
							 * return false;
							 */
							/*
							 * 释放组件资源，释放后将将不能再操作组件
							 * 通常情况下，不需要示放组件，new DtPicker(options) 后，可以一直使用。
							 * 当前示例，因为内容较多，如不进行资原释放，在某些设备上会较慢。
							 * 所以每次用完便立即调用 dispose 进行释放，下次用时再创建新实例。
							 */
							picker.dispose();
						});
					}, false);
				});
				
				mui('.datatom-date').on('change', 'input',function() {
					var id = this.id;
					if("qjstart"==id){
						var start = document.getElementById('qjstart').value;
						var end = document.getElementById('qjend').value;
						if(start!=""&&end!=""&&end<start){
							document.getElementById('qjend').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							showWebviewToast("开始时间不能小于结束时间");
							return;
						}
						var isPM = this.value.substring(11,16);
						var condition = getNowFormatDate() + " 13:00:00";
						var sys = getNowFormatDate()+ " " +getHHMMSS();
						var sysMonth = getNowFormatDate();
						var thisMonth = this.value.substring(0,10);
						if("00:00"==isPM&&sys>condition&&sysMonth==thisMonth){
							document.getElementById('qjend').value = "";
							document.getElementById('startBtn').innerHTML = "请选择时间";
							document.getElementById('qjstart').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							showWebviewToast("时间不能小于当前时间");
							return;
						}		
						if(""!=start&&""!=end){
							var date3 = new Date(end).getTime()-new Date(start).getTime();
							var dayIntervalx2 = date3 % (1000 * 3600 * 12) < 1000 * 3600 * 2 ? date3 / 1000 / 3600 / 12: date3 / 1000 / 3600 / 12 + 1;
							if(dayIntervalx2<0){
								dayIntervalx2 = 0;
							}
							document.getElementById('qjdays').value = parseInt(dayIntervalx2/2);
						}
					}else{
						var start = document.getElementById('qjstart').value;
						var end = document.getElementById('qjend').value;
						if(start!=""&&end!=""&&end<start){
							document.getElementById('qjend').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							showWebviewToast("开始时间不能小于结束时间");
							return;
						}	
						if(""!=start&&""!=end){
							var date3 = new Date(end+":59").getTime()-new Date(start+":00").getTime();
							var dayIntervalx2 = date3 % (1000 * 3600 * 12) < 1000 * 3600 * 2 ? date3 / 1000 / 3600 / 12: date3 / 1000 / 3600 / 12 + 1;
							dayIntervalx2 = parseInt(dayIntervalx2);
							if(dayIntervalx2<0){
								dayIntervalx2 = 0;
							}
							document.getElementById('qjdays').value = dayIntervalx2/2;
						}	
					}		
				});
				
				///osapi/leave.php
				document.getElementById("selectFile").addEventListener("tap",function(){
					window.javaInterface.doFileSelect();
				});
				
				//提交请销假
				document.getElementById('submitQXJ').addEventListener("tap",function(){
					var reason = document.getElementById('reason').value;
					var qjstrat = document.getElementById('qjstart').value;
					var qjend = document.getElementById('qjend').value;
					var qjdays = document.getElementById('qjdays').value;
					var qjtextarea = document.getElementById('qjtextarea').value;
					var qjarea = document.getElementById('qjarea').value;
					if(0==reason||""==reason||null==reason||undefined==reason){
						window.javaInterface.showWebviewToast("请选择请假类型!");
						return;
					}
					if(""==qjstrat||null==qjstrat||undefined==qjstrat){
						window.javaInterface.showWebviewToast("请选择开始时间!");
						return;
					}
					if(""==qjend||null==qjend||undefined==qjend){
						window.javaInterface.showWebviewToast("请选择结束时间!");
						return;
					}
					if(""==qjtextarea||null==qjtextarea||undefined==qjtextarea){
						window.javaInterface.showWebviewToast("请填写请假事由!");
						return;
					}
					if("12"==reason&&qjdays>3&&attachments.length<=0){
						showWebviewToast("病假大于三天必须上传附件证明");
						return;
					}
					mui.ajax(basePath+'/osapi/leave.php',{
						data:{
							action:'apply',
							place:qjarea,
							policenum:policenum,
							levelid:levelid,
							starttime:qjstrat,
							endtime:qjend,
							leavetypestr:reason,
							reason:qjtextarea,
							attachment:JSON.stringify(attachments)
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType:'json',//服务器返回json格式数据
						type:'POST',//HTTP请求类型
						timeout:10000,//超时时间设置为10秒；
						success:function(data){
							if(data.code=="200"){
								mui.back();
								showWebviewToast("请假申请提交成功,请等待审批!");
							}else{
								showWebviewToast("请假申请提交失败"+data.msg);
							}
						},
						error:function(xhr,type,errorThrown){
							showWebviewToast("网络异常!");
						}
					});
				});
				
				setTitle("请销假");
			})(mui);	
		</script>
	</body>
</html>