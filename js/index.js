function $j(el) {
    var selector = document.querySelectorAll(el);
    return (/^(\.|\w)/.test(el) && selector.length <= 1) || !/^(\.|\w)/.test(el) ?
    document.querySelector(el) :
    document.querySelectorAll(el);
}

//用户信息
console.log(document.cookie);
if (document.cookie.split(';').length > 1) {
    var cookieName = document.cookie.split(';')[1];
    $j('#login').innerHTML =
    '<div><a class="user-name">' +
    cookieName.slice(cookieName.indexOf('=') + 1) +
    '.</a><img align="center" src = "../static/image/girl.jpg" class ="user-img">';
    '</div>';
} else {
    // location.href= 'demo100/login.htm';
}
var boxE = $j('#box');
var imgUl = $j('.list');
var countUl = $j('.count');
var imgLiE = imgUl.getElementsByTagName("li");
var countLiE = countUl.getElementsByTagName("li");
var ArrowClick = imgUl.getElementsByTagName("span");
var timer = play = null;
var now = -1;
var next = now;
var clickState = ['skew', 'rotate', 'translate', 'scale', 'filter'];
var nowState = 'rotate';



function show(now, item, next) {
    var move, HZ;
    var deg = 90,
    alpha = 0,
    x = getComputedStyle(imgUl, false).width.replace('px', ''),
    y = getComputedStyle(imgUl, false).height.replace('px', ''),
    s = 0,
        //10倍变换...
        Nx = x / 10,
        Ny = y / 10,
        Ndeg = deg / 10;
        move = x;
        for (i = 0; i < countLiE.length; i++) countLiE[i].className = '';
            countLiE[now].className = "current";
        clearInterval(timer);

        for (var j = 0; j < imgLiE.length; j++) {

            imgLiE[j].style.cssText = '';
            if (j !== next) {
                imgLiE[0].style.zIndex = 0;

                switch (item) {
                    case 'rotate':
                    imgLiE[j].style.transform = "rotate(" + deg + "deg)";
                    break;
                    case 'skew':
                    imgLiE[j].style.transform = "skewX(-" + deg + "deg)";
                    break;
                    case 'translate':
                    imgLiE[j].style.transform = "translate(" + x + "px," + y + "px)";
                    break;
                    case 'scale':
                    imgLiE[j].style.transform = "scale(" + s + "," + s + ")";
                    imgLiE[j].style.transformOrigin = "50% 50%";
                    break;
                    case 'filter':
                    imgLiE[j].style.opacity = 0;
                    imgLiE[j].style.filter = "alpha(opacity=" + alpha + ")";
                    break;
                    default:
                    imgLiE[j].style[item] = move + "px";
                    break;
                }
            } else {
                imgLiE[0].style.zIndex = 1;
            // imgLiE[0].style.transform = '';
        }
    }
    timer = setInterval(function() {
        switch (item) {
            case 'rotate':
            deg -= Ndeg;
            imgLiE[now].style.transform = "rotate(" + deg + "deg)";
            deg == 0 && clearInterval(timer);
            break;
            case 'skew':
            deg -= 5;
            imgLiE[now].style.transform = "skewX(" + deg + "deg)";
            deg == 0 && clearInterval(timer);
            break;
            case 'translate':
            x -= Nx;
            y -= Ny;
            imgLiE[now].style.transform = "translate(" + x + "px," + y + "px)";
            (x == 0 || y == 0) && clearInterval(timer);
            break;
            case 'scale':
            s += 10;
            imgLiE[now].style.transform = "scale(" + s / 100 + "," + s / 100 + ")";
            s == 100 && clearInterval(timer);
            break;
            case 'filter':
                // console.log(alpha)
                alpha += 10;
                alpha > 100 && (alpha = 100);
                imgLiE[now].style.opacity = alpha / 100;
                imgLiE[now].style.filter = "alpha(opacity=" + alpha + ")";
                alpha == 100 && clearInterval(timer);
                break;
                default:
                console.log(Nx);
                (item == 'left' || item == 'right') && (move -= parseInt(Nx));
                // console.log(item, now, next, move)
                parseInt(move) <= 0 && (move = 0, clearInterval(timer));
                imgLiE[now].style[item] = move + "px";
                break;
            }
        }, 30)
}
//在js中if条件为null/undefined/0/NaN/ 被认为是false, 其他皆为true
function autoPlay() {
    play = setInterval(function() {
        now++;
        next = now - 1;
        now > imgLiE.length - 1 && (now = 0, next = imgLiE.length - 1);
        show(now, nowState, next);
    }, 3000);
    console.log(typeof nowState)
}
autoPlay();
$j('.changeShow').onclick = function() {
    nowState = randomArr(clickState);
}

function randomArr(arg) {
    var random = parseInt(Math.random() * 5);
    if (random <= 4) {
        return arg[random];
    }
}
boxE.onmouseover = function(e) {
    clearInterval(play);
};
boxE.onmousemove = function(e) {
    var EventDistance = e.clientX;
    var PageWidth = window.innerWidth;
    if (EventDistance <= PageWidth / 2) {
        $j('.left').style.display = 'block';
        $j('.right').style.display = 'none';
    } else {
        $j('.left').style.display = 'none';
        $j('.right').style.display = 'block';
        $j('.changeShow').style.display = 'block';

    }
    console.log(EventDistance)
}
boxE.onmouseout = function() {
    clickState = ['skew', 'rotate', 'translate', 'scale', 'filter'];
    $j('.changeShow').style.display = 'none';
    $j('.right').style.display = 'none';
    $j('.left').style.display = 'none';
    autoPlay();
};



for (var n = 0; n < ArrowClick.length; n++) {
    ArrowClick[n].onclick = function(e) {
        e.stopPropagation();
        var nameC = this.className;
        clickState = nameC;

        now++;
        next = now - 1;
        if (now > imgLiE.length - 1) {
            now = 0;

        }
        if (now == 0) {
            next = 4;
        }
        console.log(now, next)


        show(now, nameC, next);
    }
}
for (var m = 0; m < countLiE.length; m++) {
    countLiE[m].index = m;
    countLiE[m].onmouseover = function(param) {
        clearInterval(play);
        now = this.index;
        next = now - 1;
        if (now == 0) {
            next = countLiE.length - 1;
        }
        show(now, 'filter', next);
    };
}

//动态滚动容器高度
$j('#panelize').style.minHeight = parseInt(getComputedStyle($j('#box'), false).height.replace('px', '')) +
getComputedStyle($j('section')[0], false).height.replace('px', '') *
getComputedStyle($j('section')[0], false).height.replace('px', '').length +
"px";
console.log(getComputedStyle($j('#box'), false).height.replace('px', ''))
document.onscroll = function() {
    var scrollMove = document.documentElement.scrollTop;
    var zIndex = 1000;
    for (var i = 0; i < $j('section').length; i++) {
        zIndex -= 50;
        if (scrollMove > 650) {
            $j('section')[i].style.cssText = "position:fixed;z-index:" + zIndex;
            $j('header').style.background = "rgba(36, 25, 25, 1)";
        }

        switch (true) {
            case scrollMove < 610:
            $j('header').style.background = "rgba(36, 25, 25, .1)";
            break;
            case scrollMove >= 600 && scrollMove < 1000:
            i < 1 ? $j('section')[i].style.position = 'relative' : null;
            break;
            case scrollMove >= 1000 && scrollMove < 1400:
            i < 2 ? $j('section')[i].style.position = 'relative' : null;
            break;
            case scrollMove >= 1400 && scrollMove < 1800:
            i < 3 ? $j('section')[i].style.position = 'relative' : null;
            break;
            case scrollMove >= 1800:
            i < 4 ? $j('section')[i].style.position = 'relative' : null;
            break;
        }
    }

};


$j('.changeShow').onmouseover = function(e) {
    e.stopPropagation();
    showMove();
};
$j('.changeShow').onmouseout = function(e) {
    e.stopPropagation();
    hideMove();
}

function showMove() {
    var elRight = getComputedStyle($j('.changeShow'), false).right.replace('px', '');
    console.log(elRight);
    var i = parseInt(elRight);
    var leftMove = setInterval(function() {
        i++;
        if (i == 0) {
            clearInterval(leftMove);
            i = 0;
        }
        $j('.changeShow').style.right = i + 'px';
    }, 10);
}

function hideMove() {
    var elWidth = $j('.changeShow').offsetWidth;
    var i = 0;
    var rightMove = setInterval(function() {
        i--;
        if (i == -elWidth / 2) {
            clearInterval(rightMove);
            i = -elWidth / 2;
        }
        $j('.changeShow').style.right = i + 'px';
    }, 10);
}