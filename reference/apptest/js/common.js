/**
 * 定义测试环境与正式环境切换参数
 */
var isOnLine = false;
var basePath = "http://58.42.244.74:8088";
//var basePath = "http://192.168.15.242:8882";
//本地缓存
var storage = window.localStorage;
var colorArr = [{
	type: 101,
	color: "#5a96f7",
	name: "勤务处异常"
}, {
	type: 102,
	color: "#9c8abd",
	name: "车管所异常"
}, {
	type: 103,
	color: "#63cbf7",
	name: "法制处异常"
}, {
	type: 104,
	color: "#ff9239",
	name: "事故处异常"
}, {
	type: 1,
	color: "#5a96f7",
	name: "考勤异常"
}, {
	type: 2,
	color: "#9c8abd",
	name: "工作日志异常"
}, {
	type: 3,
	color: "#63cbf7",
	name: "排班异常"
}, {
	type: 4,
	color: "#e08254",
	name: "异常退办"
}, {
	type: 5,
	color: "#ee293c",
	name: "车驾异常"
}, {
	type: 6,
	color: "#fd1ad5",
	name: "档案提取异常"
}, {
	type: 7,
	color: "#c21b89",
	name: "执法记录仪异常"
}, {
	type: 8,
	color: "#e2e921",
	name: "事故异常"
}, {
	type: 9,
	color: "#eb0bf3",
	name: "六合一无数据异常"
}, {
	type: 10,
	color: "#301ee1",
	name: "送检异常"
}, {
	type: 11,
	color: "#e9732c",
	name: "检验鉴定异常"
}, {
	type: 12,
	color: "#4ae7cb",
	name: "鉴定报告领取异常"
}, {
	type: 13,
	color: "#d6ec70",
	name: "吹气异常"
}, {
	type: 14,
	color: "#8ea71b",
	name: "摇号号牌未回填"
}, {
	type: 201,
	color: "#d34ec8",
	name: "醉驾异常"
}, {
	type: 202,
	color: "#c7e24a",
	name: "摇号异常"
}, {
	type: 203,
	color: "#01fedd",
	name: "执法评估系统异常"
}, {
	type: 15,
	color: "#6be590",
	name: "基本信息维护不全"
}, {
	type: 16,
	color: "#6ecefe",
	name: "信息维护不规范"
}, {
	type: 17,
	color: "#ffcf6a",
	name: "不及时立案"
}, {
	type: 18,
	color: "#c7e98f",
	name: "审核异常"
}, {
	type: 19,
	color: "#ffa669",
	name: "不及时办理案件"
}, {
	type: 20,
	color: "#4903fa",
	name: "不及时采取强制措施"
}, {
	type: 21,
	color: "#fe00d1",
	name: "未按规定吊销驾驶证"
}, {
	type: 22,
	color: "#fe6a04",
	name: "夜巡异常"
}, {
	type: 23,
	color: "#b7d052",
	name: "PDA查验异常"
}, {
	type: 24,
	color: "#ac5fb3",
	name: "车辆检验异常"
}];

if(isOnLine) {
	basePath = "http://58.42.244.74:8088";
}

/**
 * 获取警员编号
 */
function getPolicenum() {
	if(isOnLine) {
		return window.javaInterface.getPolicenum();
	}
	return "888888";
}

function getUserid() {
	if(isOnLine) {
		return window.javaInterface.getUserid();
	}
	return "888888";
}

/**
 * 获取警员姓名
 */
function getRealname() {
	if(isOnLine) {
		return window.javaInterface.getRealname();
	}
	return '测试';
}

/**
 * 获取职位
 */
function getJobpocition() {
	if(isOnLine) {
		return window.javaInterface.getJobposition();
	}
	return "测试";
}

function getDepartmentid() {
	if(isOnLine) {
		return window.javaInterface.getDepartmentid();
	}
	return '2';
}

function getLevelid() {
	if(isOnLine) {
		return window.javaInterface.getLevelid();
	}
	return '2';
}

/**
 * 获取登录Token
 */
function getToken() {
	if(isOnLine) {
		return window.javaInterface.getToken();
	}
	//此值如果不可用则需要重新获取
	return "83788102-D1EA-010A-96EB-BD9F4957891E";
}

/**
 * 弹出提示框
 * @param {Object} str
 */
function showWebviewToast(str) {
	if(isOnLine) {
		window.javaInterface.showWebviewToast(str);
	}
}

/**
 * 设置title
 * @param {Object} str
 */
function setTitle(str) {
	if(isOnLine) {
		window.javaInterface.setTitle(str);
	}
}

/**
 * 弹出加载框
 */
function showH5Loading() {
	if(isOnLine) {
		window.javaInterface.showH5Loading();
	}
}

/**
 * 隐藏加载框
 */
function dismissH5Loading() {
	if(isOnLine) {
		window.javaInterface.dismissH5Loading();
	}
}

/**
 * 获取当前日期 yyyy-MM-dd
 */
function getNowFormatDate() {
	var date = new Date();
	var seperator1 = "-";
	var seperator2 = ":";
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var strDate = date.getDate();
	if(month >= 1 && month <= 9) {
		month = "0" + month;
	}
	if(strDate >= 0 && strDate <= 9) {
		strDate = "0" + strDate;
	}
	var currentdate = year + seperator1 + month + seperator1 + strDate;
	return currentdate;
}

function getHHMMSS() {
	var date = new Date();
	var seperator2 = ":";
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var seconds = date.getSeconds();
	if(hours >= 1 && hours <= 9) {
		hours = "0" + hours;
	}
	if(minutes >= 1 && minutes <= 9) {
		minutes = "0" + minutes;
	}
	if(seconds >= 1 && seconds <= 9) {
		seconds = "0" + seconds;
	}
	var current = hours + seperator2 + minutes +
		seperator2 + seconds;
	return current;
}

/**
 * 获取当前 yyyy
 */
function getNowYear() {
	var date = new Date();
	return date.getFullYear();
}

/**
 * 获取当前 MM
 */
function getNowMonth() {
	var date = new Date();
	var month = date.getMonth() + 1;
	return month;
}

/**
 * 获取当前 dd
 */
function getNowDate() {
	var date = new Date();
	var strDate = date.getDate();
	return strDate;
}

/**
 *  js截取字符串(支持中英文混合) 
 * @param {Object} str
 * @param {Object} n
 */
function sub(str, n) {
	var r = /[^\x00-\xff]/g;
	if(str.replace(r, "mm").length <= n) {
		return str;
	}
	var m = Math.floor(n / 2);
	for(var i = m; i < str.length; i++) {
		if(str.substr(0, i).replace(r, "mm").length >= n) {
			return str.substr(0, i) + "...";
		}
	}
	return str;
}

/**
 * 取得缓存
 * @param {Object} key
 */
function getItem(key) {
	if(null != storage.getItem(key)) {
		return storage.getItem(key);
	}
}

/**
 * 设置缓存
 * @param {Object} key
 * @param {Object} value
 */
function setItem(key, value) {
	if(storage) {
		storage.setItem(key, value);
	}
}

/**
 * 移除缓存
 * @param {Object} key
 */
function removeItem(key) {
	if(storage) {
		storage.removeItem(key);
	}
}

//获得本月的开始日期     
function getMonthStartDate(date) {
	var now = new Date(date); //当前日期     
	var monthStartDate = new Date(now.getYear(), now.getMonth(), 1);
	return formatDate(monthStartDate);
}

//获得本月的结束日期     
function getMonthEndDate(date) {
	var now = new Date(date);
	var monthEndDate = new Date(now.getYear(), now.getMonth(), getMonthDays(date));
	return formatDate(monthEndDate);
}

//获得某月的天数     
function getMonthDays(date) {
	var now = new Date(date);
	var monthStartDate = new Date(now.getYear(), now.getMonth(), 1);
	var monthEndDate = new Date(now.getYear(), now.getMonth() + 1, 1);
	var days = (monthEndDate - monthStartDate) / (1000 * 60 * 60 * 24);
	return days;
}

function getRandomColor() {
	return '#' + ('00000' + (Math.random() * 0x1000000 << 0).toString(16)).slice(-6);
}

function openNewWindow(url,id,extra) {

}