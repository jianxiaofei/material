<!--
作者：836110252@qq.com
时间：2016-05-29
描述：
-->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>接处警分析</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="../../css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/mui.picker.min.css" />

		<style>
			body,
			.mui-content {
				background-color: #fff;
			}
			
			.icon-xingxing {
				color: yellow;
			}
			
			.chart {
				height: 300px;
				margin-left: 10px;
				padding: 0px;
			}
			
			.datatom-date {
				margin: auto 0;
			}
		</style>
	</head>

	<body>
		<div class="mui-content">
			<div id="slider" class="mui-slider mui-fullscreen">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" href="#item3mobile">
						人员的处理时长
					</a>
					<a class="mui-control-item" href="#item1mobile">
						分发的任务量
					</a>
					<a class="mui-control-item" href="#item2mobile">
						受理的任务量
					</a>

				</div>
				<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>
				<div class="mui-slider-group">
					<div id="item3mobile" class="mui-slider-item mui-control-content mui-active">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>
										根据任务ID获取此任务各个大队，各个人员的处理时长(仅针对处理完成的)
									</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header" style="background-color: #5accf3;color: #FFF;">
										人员的处理时长
									</div>
									<div class="mui-content-padded">
										<div class="chart" id="pieChart"></div>

									</div>
									<div class="mui-card-footer">
										<p id="current-date1" class="mui-card-link" data-options='{"type":"date"}' href="javascript:;"></p>
										<p class="mui-card-link" data-options='{"type":"date"}'>
											选择日期
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="item1mobile" class="mui-slider-item mui-control-content">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>
										根据日期获取每天几点的任务分发量。
									</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header" style="background-color: #9a89ba;color: #FFF;">
										分发的任务量
									</div>

									<div class="mui-content-padded">
										<div class="chart" id="lineChart"></div>
									</div>

									<div class="mui-card-footer">
										<p id="current-date2" class="mui-card-link" data-options='{"type":"date"}' href="javascript:;"></p>
										<p class="mui-card-link" data-options='{"type":"date"}' style="color: #9a89ba;">
											选择日期
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="item2mobile" class="mui-slider-item mui-control-content">
						<div class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<div class="mui-content-padded">
									<p>
										根据时间段查看每个大队受理的任务量。
									</p>
								</div>
								<div class="mui-card">
									<div class="mui-card-header" style="background-color: #5bceb7;color: #FFF;">
										受理的任务量
									</div>

									<div class="mui-content-padded">
										<div class="chart" id="barChart"></div>
									</div>

									<div class="mui-card-footer">
										<p id="current-date-start" class="datatom-date" style="color: #5bceb7;" data-options='{"type":"date"}' href="javascript:;">未选择开始日期</p>
										<p id="current-date-end" class="datatom-date" data-options='{"type":"date"}' style="color: #5bceb7;">
											未选择结束日期
										</p>
									</div>
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
		<script src="../../js/echarts-all.js"></script>
		<script src="../../js/mui.picker.min.js"></script>

		<script>
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
			var currentDate = getNowFormatDate();
			var startDate = currentDate;
			var endDate = currentDate;
			var departName = new Array();
			var depart_type1 = [];
			var depart_type2 = [];
			var depart_type3 = [];
			var depart_type4 = [];
			var taskCountHour = [];
			var taskCountHour_x = [];
			var taskCountHour_y = [];

			document.getElementById("current-date1").textContent = currentDate;
			document.getElementById("current-date2").textContent = currentDate;
			document.getElementById("current-date-start").textContent = "始:" + startDate;
			document.getElementById("current-date-end").textContent = "末:" + endDate;

			var token = getToken();
			var getOption = function(chartType) {
				var chartOption = chartType == 'pie' ? {
					calculable: false,
					series: [{
						name: '访问来源',
						type: 'pie',
						radius: '65%',
						center: ['50%', '50%'],
						data: taskCountHour
					}]
				} : {
					legend: {
						data: ['交通事故', '车辆故障', "指令", "其他"]
					},
					grid: {
						x: 25,
						x2: 10,
						y: 50,
						y2: 120
					},
					toolbox: {
						show: false,
						feature: {
							mark: {
								show: true
							},
							dataView: {
								show: true,
								readOnly: false
							},
							magicType: {
								show: true,
								type: ['line', 'bar']
							},
							restore: {
								show: true
							},
							saveAsImage: {
								show: true
							}
						}
					},
					calculable: false,
					xAxis: [{

						type: 'category',
						axisLabel: {
							interval: 0,
							textStyle: {
								color: "red", //刻度颜色
								fontSize: 8 //刻度大小
							},
							rotate: 60,
						},
						data: departName
					}],
					yAxis: [{
						type: 'value',
						splitLine: {
							lineStyle: {
								color: ['#f2f2f2'],
								width: 1,
							}
						},
						axisLine: {
							lineStyle: {
								width: 1,
								color: '#f2f2f2'
							}
						},
						axisLabel: {
							textStyle: {
								align:'right',
								color: '#999',
								fontSize: 10 //刻度大小
							}
						}
					}],
					series: [{
						name: '交通事故',
						type: chartType,
						data: depart_type1
					}, {
						name: '车辆故障',
						type: chartType,
						data: depart_type2
					}, {
						name: '指令',
						type: chartType,
						data: depart_type3
					}, {
						name: '其他',
						type: chartType,
						data: depart_type4
					}]
				};
				return chartOption;
			};
			var getOption_line = function(chartType) {
				var chartOption = chartType == 'pie' ? {
					calculable: false,
					series: [{
						name: '访问来源',
						type: 'pie',
						radius: '65%',
						center: ['50%', '50%'],
						data: taskCountHour
					}]
				} : {
					legend: {
						data: ['分发量']
					},
					grid: {
						x: 35,
						x2: 10,
						y: 30,
						y2: 100
					},
					toolbox: {
						show: false,
						feature: {
							mark: {
								show: true
							},
							dataView: {
								show: true,
								readOnly: false
							},
							magicType: {
								show: true,
								type: ['line', 'bar']
							},
							restore: {
								show: true
							},
							saveAsImage: {
								show: true
							}
						}
					},
					calculable: false,
					xAxis: [{

						type: 'category',
						axisLabel: {
							interval: 0,

							textStyle: {
								color: "red", //刻度颜色
								fontSize: 5 //刻度大小
							},
							rotate: 60,
						},
						data: taskCountHour_x
					}],
					yAxis: [{
						type: 'value',
						splitArea: {
							show: true
						}
					}],
					series: [{
						name: '分发量',
						type: chartType,
						data: taskCountHour_y
					}]
				};
				return chartOption;
			};
			var byId = function(id) {
				return document.getElementById(id);
			};

			function setCurrentData(data) {
				currentDate = data;
				document.getElementById("current-date1").textContent = currentDate;
				document.getElementById("current-date2").textContent = currentDate;
			}

			function getTaskCountByHour() {
				mui.ajax(basePath + '/osapi/contactPolice.php', {
					data: {
						action: 'getTaskCountByHour',
						date: currentDate
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						console.info(JSON.stringify(data));
						if(data.code == "200") {

							var list = data.result;
							mui.each(list, function(index, item) {
								var temp = {
									"value": item.count,
									"name": item.hours + "点"
								};
								taskCountHour_x[index] = item.hours + "点";
								taskCountHour_y[index] = item.count;
								taskCountHour[index] = temp;
							});
						} else if(data.code == "250") {
							taskCountHour_x = [];
							taskCountHour_y = [];
							showWebviewToast(data.result);
						} else {
							taskCountHour_x = [];
							taskCountHour_y = [];
							showWebviewToast("错误信息：" + data.result);
						}
						taskCountHour_x.reverse();
						taskCountHour_y.reverse();
						var lineChart = echarts.init(byId('lineChart'));
						lineChart.setOption(getOption_line('line'));
						//						var pieChart = echarts.init(byId('pieChart'));
						//						pieChart.setOption(getOption('pie'));
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});
			}

			function getTaskCountByDate() {
				mui.ajax(basePath + '/osapi/contactPolice.php', {
					data: {
						action: 'getTaskCountByDate',
						begintime: startDate,
						endtime: endDate
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

							var size = list.length;
							var splite_list = [];
							for(var index = 0; index < size; index++) {
								var item = list[index];

								var bool_break = false;
								var import_index = 0;
								for(var indextemp = 0; indextemp < departName.length; indextemp++) {
									//二者名字相同
									var itemtemp = departName[indextemp];
									if(itemtemp == item.departmentname) {

										bool_break = true;

										if(item.value == "交通事故" || item.value == "交通事故") {
											depart_type1[indextemp] = depart_type1[indextemp] + item.count;
										} else if(item.value == "车辆故障") {
											depart_type2[indextemp] = depart_type2[indextemp] + item.count;
										} else if(item.value == "指令") {
											depart_type3[indextemp] = depart_type3[indextemp] + item.count;
										} else if(item.value == "其他") {

											depart_type4[indextemp] = depart_type4[indextemp] + item.count;
										}

										splite_list.push(index);
										depart_type1[index] = 0;
										depart_type2[index] = 0;
										depart_type3[index] = 0;
										depart_type4[index] = 0;
										departName[index] = item.departmentname;
										break;
									}
								}
								if(bool_break) {
									continue;
								}
								import_index = index;
								depart_type1[index] = 0;
								depart_type2[index] = 0;
								depart_type3[index] = 0;
								depart_type4[index] = 0;
								departName[index] = item.departmentname;
								if(item.value == "交通事故" || item.value == "交通事故") {
									depart_type1[index] = item.count;
								} else if(item.value == "车辆故障") {
									depart_type2[index] = item.count;
								} else if(item.value == "指令") {
									depart_type3[index] = item.count;
								} else if(item.value == "其他") {
									depart_type4[index] = item.count;
								}
							};
						} else {
							showWebviewToast(data.msg);
						}
						var temp2 = 0;

						for(var i = 0; i < splite_list.length; i++) {
							for(var j = 0; j < departName.length; j++) {
								if(splite_list[i] == j) {

									departName.splice(j, 1);
									depart_type1.splice(j, 1);
									depart_type1.splice(j, 1);
									depart_type2.splice(j, 1);
									depart_type3.splice(j, 1);
									depart_type4.splice(j, 1);

									if(i + 1 < splite_list.length) {
										temp2++;

										splite_list[i + 1] = splite_list[i + 1] - temp2;

									}
									break;
								}
							}

						}
						var barChart = echarts.init(byId('barChart'));
						barChart.setOption(getOption('bar'));
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});
			}
			(function($) {
				getTaskCountByHour();
				getTaskCountByDate();
				var btns = $('.mui-card-link');
				btns.each(function(i, btn) {
					btn.addEventListener('tap', function() {
						var optionsJson = this.getAttribute('data-options') || '{}';
						var options = JSON.parse(optionsJson);
						var id = this.getAttribute('id');
						/*
						 * 首次显示时实例化组件
						 * 示例为了简洁，将 options 放在了按钮的 dom 上
						 * 也可以直接通过代码声明 optinos 用于实例化 DtPicker
						 */
						var picker = new $.DtPicker(options);
						picker.show(function(rs) {

							currentDate = rs.text;
							setCurrentData(rs.text);
							getTaskCountByHour();
							picker.dispose();
						});
					}, false);
				});
				var start_date = document.getElementById('current-date-start');
				var end_date = document.getElementById('current-date-end');
				start_date.addEventListener('tap', function() {
					var optionsJson = this.getAttribute('data-options') || '{}';
					var options = JSON.parse(optionsJson);
					var id = this.getAttribute('id');
					/*
					 * 首次显示时实例化组件
					 * 示例为了简洁，将 options 放在了按钮的 dom 上
					 * 也可以直接通过代码声明 optinos 用于实例化 DtPicker
					 */
					var picker = new $.DtPicker(options);
					picker.show(function(rs) {
						startDate = rs.text;
						if(endDate < startDate) {
							showWebviewToast("开始时间不能大于结束时间");
							return;
						}
						document.getElementById("current-date-start").textContent = "始:" + startDate;

						getTaskCountByDate();
						picker.dispose();
					});
				}, false);
				end_date.addEventListener('tap', function() {
					var optionsJson = this.getAttribute('data-options') || '{}';
					var options = JSON.parse(optionsJson);
					var id = this.getAttribute('id');
					/*
					 * 首次显示时实例化组件
					 * 示例为了简洁，将 options 放在了按钮的 dom 上
					 * 也可以直接通过代码声明 optinos 用于实例化 DtPicker
					 */
					var picker = new $.DtPicker(options);
					picker.show(function(rs) {
						endDate = rs.text;
						if(endDate < startDate) {
							showWebviewToast("结束时间不能小于开始时间");
							return;
						}
						document.getElementById("current-date-end").textContent = "末:" + endDate;
						getTaskCountByDate();
						picker.dispose();
					});
				}, false);
			})(mui);
			setTitle('接处警数据分析'); //设置title
		</script>
	</body>

</html>