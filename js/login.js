/**
 * design by jxfstyle 
 * begin 2018-6-25
 * 
 */
//自定义选择器
function $j(el) {
    var selector = document.querySelectorAll(el);
    return (/^(\.|\w)/.test(el) && selector.length <= 1) || !/^(\.|\w)/.test(el) ?
        document.querySelector(el) :
        document.querySelectorAll(el);
}

//登录框初始化居中
var modalSize = function() {
    var Modal = $j('#container'),
        nowLeft = (window.innerWidth - Modal.offsetWidth) / 2 + 'px',
        nowTop = (window.innerHeight - Modal.offsetHeight) / 2 + 'px';
    Modal.style.left = nowLeft;
    Modal.style.top = nowTop;
    $j('#canvas').style.height = window.innerHeight + 'px';
};
modalSize();
/**
 * 验证表单
 * ajax
 * */
var timerDown;
var timerUp;

function remoteCheck(msg) {
    var tip = $j('.hide-tip');
    window.clearInterval(timerDown);
    window.clearInterval(timerUp);
    tip.innerHTML = msg;
    var i = -40;
    //滑下
    timerDown = setInterval(function() {
        i += 4;
        i >= 0 ? i = 0 : i;
        tip.style.top = i + 'px';
        if (i === 0) {
            clearInterval(timerDown);
            msg == '登录成功！' && (location.href = "../index.html");
            setTimeout(function() {
                //滑上
                timerUp = setInterval(function() {
                    i -= 4;
                    i <= -40 ? i = -40 : i;
                    tip.style.top = i + 'px';
                    if (i === -40) {
                        clearInterval(timerUp);
                    }
                }, 10);

            }, 2000);

        }
    }, 10);
}

function ajax(ele, data) {

    var result, msg;
    var xhr = new XMLHttpRequest();
    xhr.open('post', 'request.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('data=' + data); //传对象
    xhr.onreadystatechange = function(e) {
        if (xhr.readyState === 4) {
            result = JSON.parse(xhr.responseText);
            msg = result.msg;
            // var result = xhr.responseText;
            console.log(result, xhr.status);
            if (result.code === 200) {
                remoteCheck(msg);

            } else {
                remoteCheck(msg);
            }

        } else {
            msg = '<b>Request faild!</b> ' + xhr.status;
            remoteCheck(msg);
        }
    };
}
//表单非空、email格式、密码确认判断
function localCheckInput(ele, data) {
    var msg = '';
    var addTip = function(msg, element) {

        span = document.createElement('span');
        var spanText = document.createTextNode(msg);
        span.appendChild(spanText);
        span.className = 'tip';
        element.parentNode.appendChild(span);
        element.focus();

    };
    var inputs = document.getElementById(ele).getElementsByTagName('input');
    var reg = /^\w+@[a-zA-Z0-9]{2,10}(?:\.[a-z]{2,4}){1,3}$/;
    for (var i = 0; i < inputs.length; i++) {

        switch (true) {
            case ele == 'regist' && !reg.test(inputs[1].value) && inputs[1].parentNode.lastElementChild.nodeName !== "SPAN":
                msg = '邮箱格式不正确！';
                addTip(msg, inputs[1]);
                return false;
                break;
            case inputs[i].value === '' && inputs[i].parentNode.lastElementChild.nodeName !== "SPAN":
                _this = inputs[i];
                msg = '不能为空！';
                addTip(msg, inputs[i]);
                return false;
                break;
            case inputs[i].parentNode.lastElementChild.nodeName === "SPAN":
                return false;
                break;
            case ele == 'regist' && inputs[2].value !== inputs[3].value:
                msg = '两次密码不一致！';
                if (i == 3) {
                    addTip(msg, inputs[3]);
                    return false;
                }
                break;
        }
    }
    ajax(ele, data);
}

//模态框移动
function modalToggleMove(thisClass) {
    var regist = $j('#regist');
    var login = $j('#login');
    var moveRange = parseInt(getComputedStyle(login, false).width.replace('px', ''));
    console.log(moveRange);
    var i = 0;
    var j = 0;
    var Move = setInterval(function() {
        i -= 40;
        j += 40;
        switch (true) {
            case thisClass == 'goRegist' && j - 40 != moveRange:
                $j('#container').style.height = 450 + 'px';
                regist.style.display = 'block';
                regist.style.right = (j - moveRange) + 'px';
                login.style.left = i + 'px';
                break;
            case thisClass == 'goLogin' && i+40 != -moveRange:
                console.log(i);
                login.style.display = 'block';
                login.style.left = (j - moveRange) + 'px';
                regist.style.right = i + 'px';
                break;
            case thisClass == 'goRegist' && j -40 == moveRange:
                clearInterval(Move);
                login.style.display = 'none';
                modalSize();
                break;
            case thisClass == 'goLogin' && i +40 == -moveRange:
                clearInterval(Move);
                regist.style.display = 'none';
                $j('#container').style.height = 300 + 'px';
                modalSize();
                break;
        }
    }, 10);
}
// 捕获事件委托隐藏提示
$j('#boxModal').addEventListener('keyup', function(e) {
    if (e.target.nodeName == "INPUT") {
        var getAllNode = e.target.parentNode.children;
        for (var j = 0; j < getAllNode.length; j++) {
            if (getAllNode[j].nodeName == 'SPAN') {

                e.target.parentNode.removeChild(getAllNode[j]);
            }
        }
    }

}, true);

// 监听浏览器大小变化模态框居中---
window.addEventListener('resize', function() {
    modalSize();
});
//事件委托监听
$j('#boxModal').addEventListener('click', function(e) {
   var  thisClass = e.target.className;
    switch (true) {
        case thisClass == 'close':
            ($j('#container').style.display = 'none');

            break;
        case thisClass == 'goRegist':
            modalToggleMove(thisClass);
            document.title = '注册';
            break;
        case thisClass == 'goLogin':
            modalToggleMove(thisClass);
            document.title = '登陆';
            break;
        case thisClass.indexOf('regist') != -1:
            var ele = thisClass.split(' ')[0];
            var name = $j('#registName').value;
            var password = $j('#registPassword').value;
            var email = $j('#email').value;
            for (var i = 0, child = $j('.sex-radio').children; i < child.length; i++) {
                if (child[i].nodeName == "INPUT" && child[i].checked) {

                    var sex = child[i].value;

                }

            }
            var data = JSON.stringify({
                judge: true,
                name: name,
                password: password,
                email: email,
                sex: sex
            });
            localCheckInput(ele, data);
            break;
        case thisClass.indexOf('login') != -1:
            var ele = thisClass.split(' ')[0];
            var name = $j('#userName').value;
            var password = $j('#password').value;
            var data = JSON.stringify({
                judge: false,
                name: name,
                password: password
            });
            localCheckInput(ele, data);
            break;
    }

}, true);