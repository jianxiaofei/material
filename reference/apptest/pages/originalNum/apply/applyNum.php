<!--
作者：957708598@qq.com
时间：2016-09-15

-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>申请原号</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css" />
		<link rel="stylesheet" href="../../../css/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="../../../css/mui.picker.min.css" />
		<style>
			.mui-input-row label {
				font-size: .9rem;
			}
			
			.mui-input-row select,
			.mui-input-row input {
				font-size: .9rem;
			}
			
			.mui-input-row select {
				direction: rtl;
			}
			
			.mui-input-row select option {
				direction: ltr;
			}
			
			.image-item.space .image-close {
				display: none;
			}
			
			.mui-table-view .mui-active,
			.mui-table-view .mui-table-view-cell a.mui-active {
				background-color: #FFF;
				!important
			}
			
			.attachment-list img {
				width: 20px !important;
				height: 20px !important;
				line-height: 20px !important;
			}
			
			.leaveDay:after {
				visibility: hidden;
			}
			
			li .mui-input-row label {
				width: 10em;
			}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content  mui-fullscreen" style="padding-top: 5px;padding-bottom: 5px;">
			<div class="mui-scroll">
				<h5>申请信息</h5>
				<form class="mui-input-group" style="margin-bottom: 10px;">
					<div class="mui-input-row">
						<label>机动车所有人姓名</label>
						<input type="text" id="name" class="mui-input-clear" placeholder="请输入机动车所有人姓名">
					</div>
					<div class="mui-input-row">
						<label>身份证明号码</label>
						<input type="text" id="peoplenum" class="mui-input-clear" placeholder="请输入身份证明号码">
					</div>
					<div class="mui-input-row">
						<label>号牌号码</label>
						<input type="text" id="carnum" class="mui-input-clear" placeholder="请输入车牌号码">
					</div>
					<div class="mui-input-row">
						<label>流水号</label>
						<input type="text" id="waternum" class="mui-input-clear" placeholder="请输入流水号码">
					</div>
					<div class="mui-input-row">
						<label>车辆识别代号</label>
						<input type="text" id="vin" class="mui-input-clear" placeholder="请输入车架号码">
					</div>

				</form>
				<h5> 申请原因</h5>
				</ul>

				<ul class="mui-table-view" style="margin-bottom: 10px;">
					<li class="mui-table-view-cell datatom-date " style="padding:0; ">
						<div class="mui-input-row mui-navigate-right ">
							<label>申请类型</label>
							<select class="mui-btn mui-btn-block" id="errortype" name="errortype" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0; ">
								<option value="0 " class="mui-navigate-right" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0px;">请选择类型</option>
								<option value="机动车所有人错误 ">机动车所有人错误</option>
								<option value="身份证明错误 ">身份证明错误</option>
								<option value="其他">其他</option>
							</select>
						</div>
					</li>
					<li class="mui-table-view-cell datatom-date" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>号牌使用开始时间</label>
							<button id="startBtn" data-key="start" style="font-size: .9rem;width:45%;border: 0;line-height: 1;text-align: right;padding-right: 0;" class="btn mui-btn mui-btn-block">
							请选择时间
							</button>
							<input class="mui-input" id='qjstart' type="hidden" value="" />

						</div>
					</li>
					<li class="mui-table-view-cell datatom-date" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>号牌使用结束时间</label>
							<div class="mui-navigate-right">
								<button id="endBtn" data-key="end" style="font-size: .9rem;width:45%;border: 0;line-height: 1;text-align: right;padding-right: 0;" class="btn mui-btn mui-btn-block">
								请选择时间
								</button>
								<input id='qjend' type="hidden" value="" />
							</div>
						</div>
					</li>
					<li class="mui-table-view-cell datatom-date" style="padding:0;">
						<div class="mui-input-row mui-navigate-right">
							<label>原机动车去向</label>
							<select class="mui-btn mui-btn-block" id="carGo" name="carGo" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0; ">
								<option value="0 " class="mui-navigate-right" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0px;">请选择类型</option>
								<option value="注销">注销</option>
								<option value="转移">转移</option>
							</select>
						</div>
					</li>
				</ul>

				<h5> 选择附件</h5>
				</ul>

				<ul class="mui-table-view" style="margin-bottom: 10px;">
					<li class="mui-table-view-cell datatom-date " style="padding:0;" id="selectFile-attachment-applypictureid">
						<div class="mui-input-row">
							<label>原号申请表</label>
							<a href="#bottomPopover1">
								<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment " style="padding: 11px 15px;color: #888; "></span>
							</a>

						</div>
					</li>
					<ul id="attachment-applypictureid" class="mui-table-view">

					</ul>
					<li class="mui-table-view-cell datatom-date" style="padding:0;" id="selectFile-attachment-assistpictureid">
						<div class="mui-input-row ">
							<label>档案协查函</label>
							<a href="#bottomPopover2">
								<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment " style="padding: 11px 15px;color: #888; "></span>
							</a>

						</div>
					</li>
					<ul id="attachment-assistpictureid" class="mui-table-view">

					</ul>
					<li class="mui-table-view-cell datatom-date" style="padding:0;" id="selectFile-attachment-cardnumberpictureid">
						<div class="mui-input-row">
							<label style="width: 180px;">身份证明原件图片</label>
							<a href="#bottomPopover3">
								<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment " style="padding: 11px 15px;color: #888; "></span>
							</a>

						</div>
					</li>
					<ul id="attachment-cardnumberpictureid" class="mui-table-view">

					</ul>
					<li class="mui-table-view-cell datatom-date" style="padding:0;" id="selectFile-attachment-otherpictureid">
						<div class="mui-input-row">
							<label>其他信息证明图片</label>
							<a href="#bottomPopover4">
								<span class="mui-icon mui-pull-right iconfont datatom-icon-attachment " style="padding: 11px 15px;color: #888; "></span>
							</a>

						</div>
					</li>
					<ul id="attachment-otherpictureid" class="mui-table-view">

					</ul>

				</ul>
				<h5> 选择审批人</h5>
				</ul>
				<ul class="mui-table-view ">
					<li class="mui-table-view-cell datatom-date " style="padding:0;">
						<div class="mui-input-row">
							<div class="mui-input-row mui-navigate-right ">
								<label>审批人</label>
								<select class="mui-btn mui-btn-block" id="examinationpeople" name="examinationpeople" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0; ">
									<option value="0 " class="mui-navigate-right" style="font-size: .9rem;border: 0;line-height: 1;width: 45%; text-align: right; padding-right: 0px;">请选择审批人</option>

								</select>
							</div>
						</div>
					</li>
				</ul>
				<div class="mui-button-row " style="margin-top: 20px; ">
					<button id="submitNUM" type="button " class="mui-btn " style="width: 90%;height: 46px;background-color: #003b79;color: #fff; ">
					提交
					</button>
				</div>
			</div>
		</div>
		<div id="bottomPopover1" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#bottomPopover">
						<b>取消</b>
					</a>
				</li>
			</ul>
		</div>
		<div id="bottomPopover2" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#bottomPopover">
						<b>取消</b>
					</a>
				</li>
			</ul>
		</div>
		<div id="bottomPopover3" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#bottomPopover">
						<b>取消</b>
					</a>
				</li>
			</ul>
		</div>
		<div id="bottomPopover4" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#" style="color: #FF3B30;">
						相机拍照
					</a>
				</li>
				<li class="mui-table-view-cell">
					<a href="#">
						相册选择
					</a>
				</li>
			</ul>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#bottomPopover">
						<b>取消</b>
					</a>
				</li>
			</ul>
		</div>
		<script src="../../../js/mui.min.js "></script>
		<script src="../../../js/mui.picker.min.js "></script>
		<script src="../../../js/common.js "></script>
		<script>
			mui.init();
			//获取警员编号
			var policenum = getPolicenum();
			//获取登录token
			var token = getToken();
			//图片id
			var applypictureid = '';
			var assistpictureid = '';
			var cardnumberpictureid = '';
			var otherpictureid = '';
			var examinationid = '';

			function getAuditPeople() {
				mui.ajax(basePath + '/osapi/firstCode.php', {
					data: {
						action: 'getAuditPeople'
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
							var list = data.result;
							for(var i = 0; i < list.length; i++) {
								var value = list[i].policenum;
								var realname = list[i].realname;
								document.getElementById("examinationpeople").options.add(new Option(realname, value))
							}

						} else {

							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {

						showWebviewToast("网络异常!");
					}
				});
			}

			//删除申请图片附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-applypictureid").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				applypictureid = null;
			});
			//删除协查图片附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-assistpictureid").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				assistpictureid = null;
			});
			//删除身份证图片附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-cardnumberpictureid").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				cardnumberpictureid = null;
			});
			//删除其他图片附件:暂时服务器的未删除  只删除了页面显示的
			mui("#attachment-otherpictureid").on("tap", "span.deleteAttachment", function() {
				//
				this.parentNode.parentNode.parentNode.parentNode.remove();
				otherpictureid = null;
			});

			//上传附件
			function callByAndroid(json) {
				var arr = eval("(" + json + ")");
				var files = arr.files;
				var parentId = arr.attachName == null ? attachment - list : arr.attachName;
				attachments = files;
				var length = files.length;
				var item_Id = '';
				var item = '';
				var fname = '';
				for(var i = 0; i < length; i++) {
					item = files[i];
					fname = item.name;
					if(i == 0) {
						item_Id = item.id;
					} else {
						item_Id += "#";
						item_Id += item.id;
					}

					var li = document.createElement('li');
					li.className = "mui-table-view-cell mui-media";
					li.innerHTML += '<a class="attachment-list">' +
						'<img class="mui-media-object mui-pull-left" src="../../../img/txt.png"/>' +
						'<div class="mui-media-body">' + fname.substring(fname.length - 20, fname.length) + '<p class="mui-pull-right" style="padding:0px;"><span class="deleteAttachment mui-icon iconfont datatom-icon-delete" data-key="' + item.id + '"></span></p>' +
						'</div></a>';
					document.getElementById(parentId).appendChild(li);
				}
				switch(parentId) {
					case 'attachment-applypictureid':
						applypictureid = item_Id;
						break;
					case 'attachment-assistpictureid':
						assistpictureid = item_Id;
						break;
					case 'attachment-cardnumberpictureid':
						cardnumberpictureid = item_Id;
						break;
					case 'attachment-otherpictureid':
						otherpictureid = item_Id;
						break;
				}

			}
			(function($) {
				getAuditPeople();
				var btns = $('.btn');
				btns.each(function(i, btn) {
					btn.addEventListener('tap', function() {
						var key = this.getAttribute('data-key');
						var that = this;
						var customData = '{"h":[{"text":"上午","value":"上午"},{"text":"下午","value":"下午"}]}';
						var syear = parseInt(getNowYear()) - 50;

						var eyear = parseInt(getNowYear()) + 50;
						var optionsJson = '{"type":"hour","beginDay":' + getNowDate() + ',"beginMonth":' + getNowMonth() +
							',"beginYear":' + syear + ',"endYear":' +
							eyear + ',"customData":' + customData + ',"labels":["年", "月", "日", "时段"]}';
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
							var isPM = rs.text.substring(11, 14);
							if("start" == key) {

								that.innerHTML = rs.text + "开始";

								if("上午" == isPM) {
									document.getElementById('qjstart').value = rs.text.substring(0, 10) + " " + "00:00";
									var input = document.getElementById('qjstart');
									mui.trigger(input, 'change');
								} else {
									document.getElementById('qjstart').value = rs.text.substring(0, 10) + " " + "13:00";
									var input = document.getElementById('qjstart');
									mui.trigger(input, 'change');
								}
							} else {

								that.innerHTML = rs.text + "结束";

								if("上午" == isPM) {
									document.getElementById('qjend').value = rs.text.substring(0, 10) + " " + "12:59";
									var input = document.getElementById('qjend');
									mui.trigger(input, 'change');
								} else {
									document.getElementById('qjend').value = rs.text.substring(0, 10) + " " + "23:59";
									var input = document.getElementById('qjend');
									mui.trigger(input, 'change');
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

				mui('.datatom-date').on('change', 'input', function() {
					var id = this.id;
					if("qjstart" == id) {
						var start = document.getElementById('qjstart').value;
						var end = document.getElementById('qjend').value;
						if(start != "" && end != "" && end < start) {
							document.getElementById('qjend').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							window.javaInterface.showWebviewToast("开始时间不能小于结束时间");
							return;
						}
						var isPM = this.value.substring(11, 16);
						var condition = getNowFormatDate() + " 13:00:00";
						var sys = getNowFormatDate() + " " + getHHMMSS();
						var sysMonth = getNowFormatDate();
						var thisMonth = this.value.substring(0, 10);
						if("00:00" == isPM && sys > condition && sysMonth == thisMonth) {
							document.getElementById('qjend').value = "";
							document.getElementById('startBtn').innerHTML = "请选择时间";
							document.getElementById('qjstart').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							window.javaInterface.showWebviewToast("时间不能小于当前时间");
							return;
						}
						if("" != start && "" != end) {
							var date3 = new Date(end).getTime() - new Date(start).getTime();
							var dayIntervalx2 = date3 % (1000 * 3600 * 12) < 1000 * 3600 * 2 ? date3 / 1000 / 3600 / 12 : date3 / 1000 / 3600 / 12 + 1;
							if(dayIntervalx2 < 0) {
								dayIntervalx2 = 0;
							}
							document.getElementById('qjdays').value = parseInt(dayIntervalx2 / 2);
						}
					} else {
						var start = document.getElementById('qjstart').value;
						var end = document.getElementById('qjend').value;
						if(start != "" && end != "" && end < start) {
							document.getElementById('qjend').value = "";
							document.getElementById('endBtn').innerHTML = "请选择时间";
							window.javaInterface.showWebviewToast("开始时间不能小于结束时间");
							return;
						}

					}
				});

				//选择附件1
				mui('body').on('click', '#bottomPopover1 li>a', function(e) {
					var a = this,
						parent;
					//根据点击按钮，反推当前是哪个actionsheet
					for(parent = a.parentNode; parent != document.body; parent = parent.parentNode) {
						if(parent.classList.contains('mui-popover-action')) {
							break;
						}
					}
					if(a.innerText == "相机拍照") {
						window.javaInterface.doPhonePictuer("attachment-applypictureid");
					} else if(a.innerText == "相册选择") {
						window.javaInterface.doPictuerSelect("attachment-applypictureid");
					}
					//关闭actionsheet
					mui('#' + parent.id).popover('toggle');

					//	info.innerHTML = "你刚点击了\"" + a.innerHTML + "\"按钮";
				});
				//选择附件2
				mui('body').on('click', '#bottomPopover2 li>a', function(e) {
					var a = this,
						parent;
					//根据点击按钮，反推当前是哪个actionsheet
					for(parent = a.parentNode; parent != document.body; parent = parent.parentNode) {
						if(parent.classList.contains('mui-popover-action')) {
							break;
						}
					}
					if(a.innerText == "相机拍照") {
						window.javaInterface.doPhonePictuer("attachment-assistpictureid");
					} else if(a.innerText == "相册选择") {
						window.javaInterface.doPictuerSelect("attachment-assistpictureid");
					}
					//关闭actionsheet
					mui('#' + parent.id).popover('toggle');

					//	info.innerHTML = "你刚点击了\"" + a.innerHTML + "\"按钮";
				});
				//选择附件3
				mui('body').on('click', '#bottomPopover3 li>a', function(e) {
					var a = this,
						parent;
					//根据点击按钮，反推当前是哪个actionsheet
					for(parent = a.parentNode; parent != document.body; parent = parent.parentNode) {
						if(parent.classList.contains('mui-popover-action')) {
							break;
						}
					}
					if(a.innerText == "相机拍照") {
						window.javaInterface.doPhonePictuer("attachment-cardnumberpictureid");
					} else if(a.innerText == "相册选择") {
						window.javaInterface.doPictuerSelect("attachment-cardnumberpictureid");
					}
					//关闭actionsheet
					mui('#' + parent.id).popover('toggle');

					//	info.innerHTML = "你刚点击了\"" + a.innerHTML + "\"按钮";
				});
				//选择附件4
				mui('body').on('click', '#bottomPopover4 li>a', function(e) {
					var a = this,
						parent;
					//根据点击按钮，反推当前是哪个actionsheet
					for(parent = a.parentNode; parent != document.body; parent = parent.parentNode) {
						if(parent.classList.contains('mui-popover-action')) {
							break;
						}
					}
					if(a.innerText == "相机拍照") {
						window.javaInterface.doPhonePictuer("attachment-otherpictureid");
					} else if(a.innerText == "相册选择") {
						window.javaInterface.doPictuerSelect("attachment-otherpictureid");
					}
					//关闭actionsheet
					mui('#' + parent.id).popover('toggle');

					//	info.innerHTML = "你刚点击了\"" + a.innerHTML + "\"按钮";
				});
				//提交原号
				document.getElementById('submitNUM').addEventListener("tap", function() {
					var name = document.getElementById('name').value;
					var peoplenum = document.getElementById('peoplenum').value;
					var carnum = document.getElementById('carnum').value;
					var waternum = document.getElementById('waternum').value;
					var vin = document.getElementById('vin').value;
					var errortype = document.getElementById('errortype').value;
					var qjstart = document.getElementById('qjstart').value;
					var qjend = document.getElementById('qjend').value;
					var cargo = document.getElementById('carGo').value;
					examinationid = document.getElementById('examinationpeople').value;
					var content = errortype + '。号牌号码使用开始时间：' + qjstart + '，结束时间：' + qjend + '。 原机动车去向：' + cargo + '。';
					if(0 == name || "" == name || null == name || undefined == name) {
						window.javaInterface.showWebviewToast("请输入机动车所有人姓名!");
						return;
					}
					if(0 == peoplenum || "" == peoplenum || null == peoplenum || undefined == peoplenum) {
						window.javaInterface.showWebviewToast("请输入身份证明号码!");
						return;
					}
					if(0 == carnum || "" == carnum || null == carnum || undefined == carnum) {
						window.javaInterface.showWebviewToast("请输入车牌号!");
						return;
					}
					if(0 == waternum || "" == waternum || null == waternum || undefined == waternum) {
						window.javaInterface.showWebviewToast("请输入流水号!");
						return;
					}
					if(0 == vin || "" == vin || null == vin || undefined == vin) {
						vin = "";
					}
					if("" == qjstart || null == qjstart || undefined == qjstart) {
						window.javaInterface.showWebviewToast("请选择开始时间!");
						return;
					}
					if("" == errortype || null == errortype || undefined == errortype) {
						window.javaInterface.showWebviewToast("请选择申请类型!");
						return;
					}
					if("" == qjend || null == qjend || undefined == qjend) {
						window.javaInterface.showWebviewToast("请选择结束时间!");
						return;
					}
					if("" == applypictureid || null == applypictureid || undefined == applypictureid) {
						window.javaInterface.showWebviewToast("请选择申请图片!");
						return;
					}
					if("" == assistpictureid || null == assistpictureid || undefined == assistpictureid) {
						window.javaInterface.showWebviewToast("请选择协查图片!");
						return;
					}
					if("" == cardnumberpictureid || null == cardnumberpictureid || undefined == cardnumberpictureid) {
						window.javaInterface.showWebviewToast("请选择身份证图片!");
						return;
					}
					if("" == examinationid || null == examinationid || undefined == examinationid) {
						window.javaInterface.showWebviewToast("请选择审批人!");
						return;
					}

					mui.ajax(basePath + '/osapi/firstCode.php', {
						data: {
							action: 'apply',
							applyid: policenum,
							realname: name,
							carnumber: carnum,
							serialnumber: waternum,
							cardnumber: peoplenum, //身份证号码
							carshelfcode: vin, //车架号
							content: content, //申请原因
							applypictureid: applypictureid,
							assistpictureid: assistpictureid,
							cardnumberpictureid: cardnumberpictureid,
							otherpictureid: otherpictureid,
							examinationid: examinationid
						},
						beforeSend: function(request) {
							request.setRequestHeader("U-Auth-Token", token);
						},
						dataType: 'json', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						timeout: 10000, //超时时间设置为10秒；
						success: function(data) {
							if(data.code == "200") {
								window.location.reload();
								window.javaInterface.showWebviewToast("请假申请提交成功,请等待审批!");
							} else {
								window.javaInterface.showWebviewToast("提交失败" + data.code);
							}
						},
						error: function(xhr, type, errorThrown) {
							showWebviewToast("applyid>>" + policenum + "applypictureid>>" + applypictureid + "assistpictureid>>" + assistpictureid + "cardnumberpictureid>>" + cardnumberpictureid + "otherpictureid>>" + otherpictureid + "examinationid>>" + examinationid);
							window.javaInterface.showWebviewToast("网络异常!xhr>>" + JSON.parse(xhr) + "type>>" + type + "errorThrown>>" + errorThrown);
						}
					});
				});
				setTitle("申请原号");
			})(mui);
		</script>
	</body>

</html>