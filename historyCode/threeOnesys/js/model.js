var Request = (function(){
    var post = function(url, data, success, error, opts){
        return request(url, data, 'post', success, error, opts);
    };

    var get =  function(url, data, success, error, opts){
        return request(url, data, 'get', success, error, opts);
    };

    function request(url, data, type, success, error, opts){
        var param = opts || {};
        param['url'] = url;
        param['dataType'] = 'json';
        param['data'] = data;
        param['type'] = type;
        param['success'] = success;
        param['error'] = error;
        var xhr = $.ajax(param);
        return;
    }

    return {
        post:post,
        get:get
    };
})();

var Model = (function(){
    var urlMap = {
		'policehealtPoliceLogin': {'url':'policehealth_login.php','opt':{'action':'checkPoliceLogin'}},
        'checkManagerLogin': {'url':'policehealth_login.php','opt':{'action':'checkManagerLogin'}},
        'getloginHealth': {'url':'policehealth_users.php','opt':{'action':'getlogin'}},
    }
    var handler = {};
    for(var name in urlMap){
        handler[name] = (function(obj){
                var reqtype = obj['type'] || 'post';
                var url = '../../osapi/' + obj['url'];
                var opt = obj['opt'];
                var fun = function(param, success, inopts, error){
                    var opts = inopts || {};
                    var data = param ||{};
                    data['action'] = data['action'] || opt['action'];
                    return Request[reqtype](url, data, function(res){
                        success(res);
                    }, function(res){
                        var callback = error || '';
                        if(callback === ''){
                            success({code:300});
                        }else{
                            error(res)
                        }
                    }, opts);
                };
            return fun;
        })(urlMap[name] || {});
    }
    return handler;
})();
