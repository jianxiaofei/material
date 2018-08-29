<!--
作者：836110252@qq.com
时间：2016-05-29
描述：原号：原号详情
-->
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<title>原号详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<!--标准mui.css-->
		<link rel="stylesheet" href="../../css/mui.min.css" />
		<style>
			html,
			body,
			.mui-content {
				color: #888;
				background-color: #FFF;
			}
			
			.datatom-text-left {
				text-align: left;
			}
			
			.mui-table-view {
				background-color: transparent;
			}
			
			.mui-table-view:before {
				height: 0px;
			}
			
			.mui-table-view:after {
				height: 0px;
			}
			
			.datatom-footer {
				position: fixed;
				z-index: 10;
				right: 0;
				left: 0;
				border-bottom: 0;
				background-color: #fff;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				-webkit-backface-visibility: hidden;
				backface-visibility: hidden;
				bottom: 0;
				display: table;
				width: 100%;
				height: 44px;
				padding: 0;
				table-layout: fixed;
				border-top: 0;
				-webkit-touch-callout: none;
			}
			
			.datatom-item {
				text-decoration: none;
				display: table-cell;
				overflow: hidden;
				width: 1%;
				height: 44px;
				text-align: center;
				vertical-align: middle;
				white-space: nowrap;
				text-overflow: ellipsis;
				color: #007aff;
			}
			
			.mui-col-sm-2 img,
			.mui-col-sm-7 img {
				width: 50px;
				height: 50px;
				border-radius: 50%;
			}
			
			.datatom-border-bottom {
				border-bottom: 1px solid #888;
			}
			
			.datatom-img-tips {
				position: absolute;
				right: 5%;
			}
			
			.datatom-line {
				border: 1px solid #888;
				height: 1px;
				margin-left: 10px;
				margin-right: 10px;
			}
			
			.mui-preview-image.mui-fullscreen {
				position: fixed;
				z-index: 20;
				background-color: #000;
			}
			
			.mui-preview-image {
				display: none;
				-webkit-animation-duration: 0.5s;
				animation-duration: 0.5s;
				-webkit-animation-fill-mode: both;
				animation-fill-mode: both;
			}
			
			.mui-preview-image.mui-preview-in {
				-webkit-animation-name: fadeIn;
				animation-name: fadeIn;
			}
			
			.mui-preview-image.mui-preview-out {
				background: none;
				-webkit-animation-name: fadeOut;
				animation-name: fadeOut;
			}
			
			.mui-preview-image.mui-preview-out .mui-preview-header,
			.mui-preview-image.mui-preview-out .mui-preview-footer {
				display: none;
			}
			
			.mui-zoom-scroller {
				position: absolute;
				display: -webkit-box;
				display: -webkit-flex;
				display: flex;
				-webkit-box-align: center;
				-webkit-align-items: center;
				align-items: center;
				-webkit-box-pack: center;
				-webkit-justify-content: center;
				justify-content: center;
				left: 0;
				right: 0;
				bottom: 0;
				top: 0;
				width: 100%;
				height: 100%;
				margin: 0;
				-webkit-backface-visibility: hidden;
			}
			
			.mui-zoom {
				-webkit-transform-style: preserve-3d;
				transform-style: preserve-3d;
			}
			
			.mui-slider .mui-slider-group .mui-slider-item img {
				width: auto;
				height: auto;
				max-width: 100%;
				max-height: 100%;
			}
			
			.mui-preview-loading {
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
			}
			
			.mui-preview-loading.mui-active {
				display: block;
			}
			
			.mui-preview-loading .mui-spinner-white {
				position: absolute;
				top: 50%;
				left: 50%;
				margin-left: -25px;
				margin-top: -25px;
				height: 50px;
				width: 50px;
			}
			
			.mui-preview-image img.mui-transitioning {
				-webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
				transition: transform 0.5s ease, opacity 0.5s ease;
			}
			
			@-webkit-keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			
			@keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			
			@-webkit-keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}
			
			@keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}
			
			p img {
				max-width: 100%;
				height: auto;
			}
			
			.mui-row label {
				font-size: .9rem;
			}
		</style>
	</head>

	<body>
		<div class="mui-content mui-fullscreen">
			<div class="mui-scroll" id="content">
				<div class="mui-loading">
					<div class="mui-spinner"></div>
				</div>
			</div>
		</div>
		<script src="../../js/mui.min.js"></script>
		<script src="../../js/common.js" charset="UTF-8"></script>
		<script src="../../js/mui.zoom.js"></script>
		<script src="../../js/mui.previewimage.js"></script>
		<script>
			mui.init({
				swipeBack: false
			});

			//初始化单页的区域滚动
			mui('.mui-scroll-wrapper').scroll();

			(function($) {
				var id = <?php echo "'". $_GET["id"] . "'" ?>;
				var policenum = getPolicenum();
				var token = getToken();
				mui.ajax(basePath + '/osapi/firstCode.php', {
					data: {
						action: 'getApplyInfoById',
						id: id
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						if(data.code == "200") {
							var item = data.result;
							var imageurls_applypictureid = item.applypictureid.split("#");
							var imageurls_assistpictureid = item.assistpictureid.split("#");
							var imageurls_cardnumberpictureid = item.cardnumberpictureid.split("#");
							var imageurls_otherpictureid = '';
							if(item.otherpictureid != null) {
								imageurls_otherpictureid = item.otherpictureid.split("#");
							}

							console.info("个数(0):" + imageurls_applypictureid);
							console.info("个数(1):" + imageurls_applypictureid[1]);

							var content = document.getElementById('content');
							var html = '';

							html += '<div class="mui-content-padded">';
							html += '<div class="mui-card"><div class="mui-card-content"><div class="mui-card-content-inner">'
							html += '<div class="mui-row">';
							html += '<div class="mui-text-center mui-col-sm-2 mui-col-xs-3">';
							html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.applyid + '" class=""/></div>';
							html += '<div class="mui-col-sm-1 mui-col-xs-2"></div>';
							html += '<div class="mui-col-sm-9 mui-col-xs-7">';
							html += '<p>' + item.applyname + '</p><p style="marigin-bottom: 0;">' + item.applydepartment + '</p></div></div>'
							html += '</div></div></div>'

							html += '<div class="mui-card"><div class="mui-card-content">'
							html += '<div class="mui-card-header"><label style="padding-left:10px;color:#000000;">原号申请信息<label></div>'
							html += '<div class="mui-card-content-inner">'
							html += '<div class="mui-row">';
							if(item.status == "审批通过") {
								html += '<img class="datatom-img-tips" src="../../img/passapply.png"/>';
							} else if(item.status == "审批不通过") {
								html += '<img class="datatom-img-tips" src="../../img/nopassapply.png"/>';
							} else {
								html += '<img class="datatom-img-tips" src="../../img/waitapply.png"/>';
							}
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 汽车所有人:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.realname + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 车牌号:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.carnumber + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 流水号:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.serialnumber + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 身份证号码:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.cardnumber + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 车架号:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.carshelfcode + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 申请原因:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.content + '</label></div></div></div>'
							html += '</div></div></div>'

							html += '<div class="mui-card"><div class="mui-card-content">'
							html += '<div class="mui-card-header"><label style="padding-left:10px;color:#000000;">原号审批信息<label></div>'
							html += '<div class="mui-card-content-inner">'
							html += '<div class="mui-row">';
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 审批人警号:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.examinationid + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 审批人姓名:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.examinationname + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px;">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 审批人部门:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.examinationdepartment + '</label></div></div>'
							html += '<div class="mui-row mui-text-content"style="padding-left:10px;padding-top:10px">'
							html += '<div class="mui-col-sm-3 mui-col-xs-4">'
							html += '<label> 审批原因:</label>'
							html += '</div><div class="mui-col-sm-1 mui-col-xs-1">'
							html += '</div><div class="mui-col-sm-8 mui-col-xs-7"><label>'
							html += item.reason + '</label></div></div>'
							html += '</div></div></div></div>'

							html += '<div class="mui-card"><div class="mui-card-content">'
							html += '<div class="mui-card-header"><label style="padding-left:10px;color:#000000;">原号附件信息<label></div>'
							html += '<div class="mui-card-content-inner">'
							html += '<div class="mui-row">';
							html += '<div class="mui-row mui-text-content"style="padding-left:10px">'
							html += '<div class="mui-col-sm-3 mui-col-xs-3">'
							html += '<label> 审批图片:</label>'

							html += '<ul class="mui-table-view">';
							var s_1 = eval(imageurls_applypictureid)
							mui.each(s_1, function(index, item) {
								console.info("shenpi>>" + item)
								html += '<li class="mui-media">'
								html += '<div class="mui-col-sm-2 mui-col-xs-1">';
								html += '<img data-preview-src="" data-preview-group="1" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
								html += '</li>'
							});
							html += '</ul></div>'

							html += '<div class="mui-col-sm-3 mui-col-xs-3">'
							html += '<label> 协查图片:</label>'
							html += '<ul class="mui-table-view">';
							var s_2 = eval(imageurls_assistpictureid)
							mui.each(s_2, function(index, item) {
								html += '<li class="mui-media">'
								html += '<div class="mui-col-sm-2 mui-col-xs-1">';
								html += '<img data-preview-src="" data-preview-group="2" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
								html += '</li>'
							});
							html += '</ul></div>'

							html += '<div class="mui-col-sm-3 mui-col-xs-3">'
							html += '<label> 身份图片:</label>'
							html += '<ul class="mui-table-view">';
							var s_3 = eval(imageurls_cardnumberpictureid)
							mui.each(s_3, function(index, item) {
								console.info("shenfen>>" + item)
								html += '<li class="mui-media">'
								html += '<div class="mui-col-sm-2 mui-col-xs-1">';
								html += '<img data-preview-src="" data-preview-group="3" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
								html += '</li>'
							});
							html += '</ul></div>'

							html += '<div class="mui-col-sm-3 mui-col-xs-3">'
							html += '<label> 其他图片:</label>'
							if(item.otherpictureid != null) {
								html += '<ul class="mui-table-view">';
								var s_4 = eval(imageurls_otherpictureid)
								mui.each(s_4, function(index, item) {
									html += '<li class="mui-media">'
									html += '<div class="mui-col-sm-2 mui-col-xs-1">';
									html += '<img data-preview-src="" data-preview-group="4" width="50px" height="50px" src="http://58.42.244.76:8088/api/cluster/storage/file/download?fileid=' + item + '&ACCESS-TOKEN=X7yABwjE20sUJLefATUFqU0iUs8mJPqEJo6iRnV63mI="/></div>'
									html += '</li>'
								});
								html += '</ul></div>'
							}

							content.innerHTML = html;
						} else {
							showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						showWebviewToast("网络异常!");
					}
				});

				setTitle('原号详情'); //设置title

			})(mui);
			mui.previewImage();
		</script>
	</body>

</html>