window.onload = function () {

    var liArr = document.querySelectorAll(".tabs ul li");
    var spanArr = document.querySelectorAll(".tabs-items");

    for (var i = 0; i < liArr.length; i++) {
        //绑定索引值（新增一个自定义属性：index属性）
        liArr[i].index = i;
        liArr[i].onclick = function () {

            //1.点亮上面的盒子。   2.利用索引值显示下面的盒子。(排他思想)
            for (var j = 0; j < liArr.length; j++) {
                liArr[j].className = "";
                spanArr[j].className = "tabs-items";
            }
            this.classList.add("li-active");
            spanArr[this.index].classList.add("show"); //【重要代码】
        }
    }





    // 返回顶部
    window.onscroll = function () {
        var top = document.body.scrollTop || document.documentElement.scrollTop;
        console.log(top)
        console.log(document.body.scrollTop);
        console.log(document.documentElement.scrollTop);

        if (top >= 1080) {
            let goTop = document.getElementById('goTop')
            goTop.style.display = "block"

            // console.log(goTop);
            var timer = null;
            goTop.onclick = function () {
                cancelAnimationFrame(timer);
                //获取当前毫秒数
                var startTime = +new Date();
                //获取当前页面的滚动高度
                var b = document.body.scrollTop || document.documentElement.scrollTop;
                var d = 500;
                var c = b;
                timer = requestAnimationFrame(function func() {
                    var t = d - Math.max(0, startTime - (+new Date()) + d);
                    document.documentElement.scrollTop = document.body.scrollTop = t * (-c) / d + b;
                    timer = requestAnimationFrame(func);
                    if (t == d) {
                        cancelAnimationFrame(timer);
                    }
                });
            }
        } else if (top < 1080) {

            // 返回顶部样式
            let goTop = document.getElementById('goTop')
            goTop.style.display = "none"

        }
    }

    // 文字溢出隐藏
    // var module1 = document.querySelector(".tabs-items-content-title");
    // $clamp(module1, { clamp: 2 });
    // var module2 = document.querySelector(".tabs-items-content-text");
    // $clamp(module2, { clamp: 3 });


    

};



//招商政策详情,查看详情
var home_module = (function () {
    var show_detail = function show_detail(objthis) {
        var mobile_phone = $(objthis).attr('mobile-phone');
        var url = $(objthis).attr('data-url');
        var login_url2 = $(objthis).attr('login_url');
        var loca_url2 = $(objthis).attr('loca_url');
        var loca_url = encodeURIComponent(loca_url2);
        var login_url = login_url2 + '?artId=' + loca_url;

        var data_id = $(objthis).attr('data-id');
        if (mobile_phone == undefined || mobile_phone == '') {
            //location.href = login_url;
            window.open(login_url);
        } else {
            location.href = url;
        }
    };
    return {
        show_detail: show_detail,
    };
})();


