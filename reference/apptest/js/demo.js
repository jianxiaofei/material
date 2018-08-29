//获取storage
mui.plusReady(function() {
	token = plus.storage.getItem('token');

});
//存储storage
mui.plusReady(function() {
	plus.storage.setItem("policenum", policeInfoModel.policenum);
});

//界面接收父界面传过来的参数
mui.plusReady(function() {
	var self = plus.webview.currentWebview();
	ids = self.ids;
	mui.toast(ids);
})

//打开界面并且传递参数
mui.openWindow({
	url: '../pages/contacts/judgments.php',
	id: 'judgments.php',
	extras: {
		usernum: usernum
	}
});

