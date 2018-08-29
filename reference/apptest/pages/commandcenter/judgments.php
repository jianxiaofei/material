<!--
	作者：836110252@qq.com
	时间：2016-07-25
	业务描述：
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>指挥中心任务评价</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" href="../../css/mui.min.css">
	<link rel="stylesheet" href="../../css/iconfont.css" />
	<style>
	.icon-xingxing{
		color: red;
	}
	.icons{
		padding: 5px 15px;
	    float: right;
	    width: 65%;
	    margin-bottom: 0;
	    padding-left: 0;
	    border: 0;
	}
	</style>
</head>
<body class="mui-fullscreen">
	<div class="mui-content">
		<!--<div class="row mui-input-row">
			<select id="people" name="usernum">
				<option value="1">测试</option>
				<option value="1">测试</option>
				<option value="1">测试</option>
			</select>
		</div>-->
		<div class="row mui-input-row">
			<textarea id="content" rows="10" 
				class="mui-input-clear content" 
				placeholder="请输入评价内容"></textarea>
		</div>
		<div class="mui-input-row" style="color: #888;">
			<label style="text-align: right;">星级：</label>
			<div class="icons">
				<i data-index="1" class="mui-icon mui-icon-star-filled"></i>
				<i data-index="2" class="mui-icon mui-icon-star-filled"></i>
				<i data-index="3" class="mui-icon mui-icon-star-filled"></i>
				<i data-index="4" class="mui-icon mui-icon-star-filled"></i>
				<i data-index="5" class="mui-icon mui-icon-star-filled"></i>
			</div>
		</div>
		<div class="mui-button-row" style="margin-top: 20px;margin-bottom: 20px;">
			<button id="submitAddTask" type="button" class="mui-btn" style="background-color: #003b79;width: 90%;height: 46px;color: #FFF;">提交</button>
		</div>
	</div>
<script src="../../js/mui.min.js" charset="UTF-8"></script>
<script src="../../js/common.js" charset="UTF-8"></script>
<script>
	mui.init({
		gestureConfig:{
            tap: true, //默认为true
            doubletap: true, //默认为false
            longtap: true, //默认为false
            drag: true, //默认为true
            hold: true, //默认为false，不监听
            release: true //默认为false，不监听
        },
		swipeBack: false
	});
				
	var token = getToken();
	var policenum = getPolicenum();
	var realname = getRealname();
	var score = 0;
	var id = <?php echo "'". $_GET["id"] . "'" ?>;
	
	(function($) {	
		
		mui('.icons').on('click','i',function(){
			 	var index = parseInt(this.getAttribute("data-index"));//获取当前元素的索引值
			 	var parent = this.parentNode;//获取当前元素的父节点 
                var children = parent.children;//获取父节点下所有子元素
                if(this.classList.contains("icon-xingxing")){//判断当前节点列表中是否含有.mui-icon-star元素
                    for (var i = index; i < 5; i++) {                        	
                        children[i].classList.remove('icon-xingxing');
                        children[i].classList.remove('mui-icon-starhalf');  
                    }                                          
                	if(this.classList.contains('mui-icon-starhalf')){
                		this.classList.remove('mui-icon-starhalf');
                		score = 2*index;
                	}else{
                		this.classList.remove('icon-xingxing');
                		score = 2*(index-1);
                	}
                }else{//重置已经亮星的元素 
                	score = 2*(index-1)+1;
                	for(var i=0;i<index;i++){//亮星
                		if(index-1==i){
                			children[i].classList.remove('icon-xingxing');
                			children[i].classList.remove('mui-icon-starhalf');
                       		children[i].classList.add('mui-icon-starhalf');
                       		children[i].classList.add('icon-xingxing');
                		}else{
                			children[i].classList.remove('mui-icon-starhalf');
                			children[i].classList.remove('icon-xingxing');
                       		children[i].classList.add('icon-xingxing');
                		}
                   	} 
                }
			 });
		
		//保存
		document.getElementById("submitAddTask").addEventListener("tap",function(){
			var content = document.getElementById("content").value;
			//var imageurls = JSON.stringify(attachments);
			
			if(""==content||null==content){
				showWebviewToast("评价内容不能为空!");
				return;
			}
			mui.ajax(basePath+'/osapi/task_distribution_new_app.php',{
				data:{
					action:'evaluateTask',
					taskid:id,
					content:content,
					name:realname,
					/*score:score,*/
					policenum:policenum/*,
					enclosureid:imageurls*/
				},
				beforeSend: function(request) {
					request.setRequestHeader("U-Auth-Token", token);
				},
				dataType:'json',//服务器返回json格式数据
				type:'POST',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					if(data.code=="200"){
						window.location.href = "detail.php?id="+id;
						showWebviewToast("任务评价成功!");
					}else{
						showWebviewToast(data.msg);
					}
				},
				error:function(xhr,type,errorThrown){
					showWebviewToast("网络异常");
				}
			});
		});
		
		setTitle("任务评价");
	})(mui);
</script>
</body>
</html>
