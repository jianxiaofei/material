/**
 * author：Alex
 * date：2017-05-03
 */

var consoleLog = true;
//输出控制台log方法
function LL(msg) {
	if(consoleLog) {
		console.info(msg);
	}
}
//json对象转字符串方法
function obj2str(obj) {
	var str = "";
	str = JSON.stringify(obj);
	return str;
}
//获取路径中的文件名
function getFileName(path) {
	var name;
	path = path.split("/");
	name = path[path.length - 1];
	return name;
}

//获取当月有多少天

//判断是否是闰年
// 判断闰年
function isLeapYear(year) {
	if((year % 4 == 0) && (year % 100 != 0 || year % 400 == 0)) {
		return true;
	} else {
		return false;
	}
}