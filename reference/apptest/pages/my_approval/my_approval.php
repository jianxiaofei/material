<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的审批</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--标准mui.css-->
	<link rel="stylesheet" href="../../css/mui.min.css">
	<style>

		body, .mui-content {
			color: #888888;
			background-color: #ffffff;
			font-size: 12px;
		}

		p {
			font-size: 12px;
		}

		.mui-table-view {
			padding-top: 3%;
		}

		.mui-slider .mui-segmented-control.mui-segmented-control-inverted~.mui-slider-group .mui-slider-item {
			border: none;
		}

		.mui-table-view-cell:after {
			background-color: #ffffff;
		}

		.mui-control-content {
			background-color: white;
			min-height: 300px;
		}

		.mui-slider .mui-slider-group .mui-slider-item img {
			width: 50%;
			border-radius:50%;
		}

		.mui-table-view-cell div {
			float: left;
			font-size: 10px;
		}

		.mui-table-view-cell div:first-child {
			width: 16%;
			text-align: center;
		}

		.mui-table-view-cell {
			padding: 0;
			margin-left: 10%;
		}

		.time_zhou {
			display: block;
		}

		.mui-table-view .mui-table-view-cell {
			margin-top: -1%;
		}

		.mui-table-view .mui-table-view-cell:first-child {
			margin-top: 0;
		}

		.results {
			color:#0504f8;
		}

		.mui-icon-close {
			color:#33b112;
		}

		.kongle {
			display: inline-block;
			width: 24px;
		}

		.mui-slider-indicator {
			z-index: 100;
			background-color: #ffffff;
		}

	</style>
</head>
<body>
<div class="mui-content">
	<div id="slider" class="mui-slider">
		<div id="sliderSegmentedControl"
			 class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
			<a class="mui-control-item" href="#item1mobile">
				考勤
			</a>
			<a class="mui-control-item" href="#item2mobile">
				请假
			</a>
			<a class="mui-control-item" href="#item3mobile">
				加班
			</a>
		</div>
		<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>
		<div class="mui-slider-group">
			<div id="item1mobile" class="mui-slider-item mui-control-content mui-active">
				<div id="scroll1" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<ul class="mui-table-view">
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
							<li class="mui-table-view-cell">
								<div>
									<img src="../../img/avantar.png" alt="图片暂时无法显示">
									<p>张小虎</p>
									<span class="mui-icon mui-icon-close"></span>
								</div>
								<div>
									<img class="time_zhou" src="../../img/time_zhou.png" alt="">
									<img class="time_zhou" src="../../img/time_zhou2.png" alt="">
								</div>
								<div>
									<p class="results">正常</p>
									<p>发生时间：<span>06月07日(周日)</span></p>
									<p>提交时间：<span>06月08日 14:32</span></p>
									<p>其<span class="kongle"></span>他：<span>中午忘记打卡</span></p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="item2mobile" class="mui-slider-item mui-control-content">
				<div id="scroll2" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						222
					</div>
				</div>

			</div>
			<div id="item3mobile" class="mui-slider-item mui-control-content">
				<div id="scroll3" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						333
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../../js/mui.min.js" charset="UTF-8"></script>
<!--<script src="../../js/common.js" charset="UTF-8"></script>-->
<script>
	mui.init();
	(function($){
		mui('#item1mobile').pullRefresh({
			up: {
				contentrefresh: "正在加载..."
//				callback: messagePullUpRefresh
			},
			down:{
				contentrefresh: "正在加载..."
//				callback: messagePullDownRefresh
			}
		});
		var tags=document.getElementsByTagName("li");
		var hei = document.getElementById("item1mobile");
		var li_minheight = tags.length*100;
		hei.style.height = li_minheight+"px";
		window.javaInterface.setTitle('我的审批'); //设置title
	})(mui);
</script>
</body>
</html>