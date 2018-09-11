(function(window, document, undefined) {
    var jsonp = function(url, data, callback) {
        // 回调函数+时间戳
        var cbName = 'callback_' + new Date().getTime();
        // 判读查询字符串最后一位是否为?或者是&
        var queryString = url.indexOf('?') == -1 ? '?' : '&';
        // 遍历传进来的data实参赋值给查询字符串
        for (var k in data) {
            queryString += k + '=' + data[k] + '&';
        }
        // 查询字符串加上回调函数
        queryString += 'callback=' + cbName;
        console.log(document);
        // 创建script标签
        var ele = document.createElement('script');
        // 给script标签添加src属性值
        ele.src = url + queryString;
        window[cbName] = function(data) {
            callback(data);
            document.getElementsByTagName("body")[0].removeChild(ele);
        };
        // 添加到body尾部
        document.getElementsByTagName("body")[0].appendChild(ele);
    };
    //jsonp函数暴露给window
    window.$jsonp = jsonp;
})(window, document, undefined);

/*
    // 调用
 $jsonp('http://api.douban.com/v2/movie/in_theaters', {
        'count': 3
    }, function(data) {
        console.log(data);
    });

*/