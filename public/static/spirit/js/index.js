window.onload = function () {

    var liArr = document.querySelectorAll(".project-tabs");
    var spanArr = document.querySelectorAll(".project-tabs-items");

    for (var i = 0; i < liArr.length; i++) {
        //绑定索引值（新增一个自定义属性：index属性）
        liArr[i].index = i;
        liArr[i].onclick = function () {

            //1.点亮上面的盒子。   2.利用索引值显示下面的盒子。(排他思想)
            for (var j = 0; j < liArr.length; j++) {
                liArr[j].className = "project-tabs";
                spanArr[j].className = "project-tabs-items";
            }
            this.classList.add("tab-active");
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

    // 溢出隐藏

    // var module1 = document.querySelector(".consulting-item-content-details");
    // $clamp(module1, { clamp: 3 });
    // var module2 = document.querySelector(".consulting-item-content-title");
    // $clamp(module2, { clamp: 2 });

}