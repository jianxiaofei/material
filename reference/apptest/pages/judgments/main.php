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
        .flex-container {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-flow: row wrap;
            justify-content: space-between;
            text-align: center;
        }
        .mui-content-padded {
            padding: 5% 7.5%;
        }
        .mui-content-padded a {
            margin-top: 2px;
            width: 100px;
            height: 100px;
            display: inline-block;
            text-align: center;
            background-color: #3bc2b4;
            border: 1px solid #ddd;
            border-radius: 50px;
            background-clip: padding-box;

        }
        .mui-content-padded a .mui-icon {
            margin-top: 12px;
        }
        .mui-spinner,
        .mui-spinner-white {
            margin-top: 12px
        }
        .active .mui-spinner-indicator {
            background: #007AFF;
        }
        .mui-content a {
            color:#fff;
        }
        .text {
            font-weight: bold;
        }

        .box {
            width: 110px;
            height: 110px;
            border: 3px solid #b0e8dd;
            border-radius: 50%;
        }

        .flex-container div a {
            padding-top: 30%;
        }

        p {
            font-size: 1rem;
            color:#ffffff;
        }

        .mui-content-padded a .mui-icon {
            margin-top: 0;
        }
    </style>
	</head>
	<body>
		<div class="mui-content">
			<div class="mui-content-padded">
				<div class="flex-container">
					<div class="box">
						<a id="icon-icon-contact"><span class="text">日常评价</span><p>6<i class="mui-icon mui-icon-star-filled"></i></p></a>
					</div>
				   <div class="box">
					   <a id="icon-icon-contact1"><span class="text">任务评价</span><p>5<i class="mui-icon mui-icon-star-filled"></i></p></a>
				   </div>
				</div>
			</div>
		</div>
		<script src="../../js/mui.min.js" charset="UTF-8"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init();
			window.javaInterface.setTitle('我的评价'); //设置title
		</script>
	</body>
</html>