window.onload = function () {


  window.onscroll = function () {
    var top = document.body.scrollTop || document.documentElement.scrollTop;
    var box = document.getElementById("headerContent");
    var logo = document.getElementById("logo");
    var headerTotal = document.getElementById("headerTotal");
    var ul = document.querySelector(".content ul")
    var register = document.querySelector('.register')
    var uinfo = document.querySelector('.u_info')
    var goTop = document.querySelector("goTop")
    if (top >= 1080) {
      box.style.backgroundColor = "#031c36";
      box.style.position = 'fixed'
      box.style.top = "0px"
      box.style.left = "0px"

      box.classList.add("header_content_two")
      logo.classList.add('content_logo_two')
      ul.classList.add('two')
      // register.classList.add('register_two')


      // uinfo.classList.add('u_info_two')
      // uinfo.style.marginTop = '1rem'


      // box.style.top='0'+px
      // logo.style.display = 'none'
      headerTotal.style.position = 'absolute'
      // goTop.style.position='fixed'
      // goTop.style.top=0+'px'

      // 返回顶部
      var goTop = document.getElementById('goTop')
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
      box.style.backgroundColor = "";
      logo.style.display = 'block'
      box.style.position = ''
      headerTotal.style.position = ''

      box.classList.remove("header_content_two")
      logo.classList.remove('content_logo_two')
      ul.classList.remove('two')
      // register.classList.remove('register_two')
      // uinfo.classList.remove('u_info_two')

      // 返回顶部样式
      var goTop = document.getElementById('goTop')
      goTop.style.display = "none"
    }


    

  };

  // 导航栏样式切换

  // var menuList = document.querySelectorAll('#headerContent ul li')
  // var menuUl = document.querySelector('#headerContent ul')
  // menuList.forEach((item, index) => {
  //   item.onmouseenter = function (event) {
  //     var li = document.getElementsByClassName('nav-active')[0]
  //     li.classList.remove('nav-active')
  //     item.classList.add('nav-active')
  //   }
  // })
  // menuUl.onmouseleave = function () {
  //   var li = document.getElementsByClassName('nav-active')[0]
  //   li.classList.remove('nav-active')
  //   menuList[0].classList.add('nav-active')
  // }

  var menuList = document.querySelectorAll('#headerContent ul li')
  var menuUl = document.querySelector('#headerContent ul')

  for (var i = 0; i < menuList.length; i++) {
    menuList[i].onmouseenter = function () {
      var li = document.querySelectorAll('.nav-active')[0]
      li.classList.remove('nav-active')
      this.classList.add('nav-active')
    }
  }

  menuUl.onmouseleave = function () {
    var li = document.querySelectorAll('.nav-active')[0]
    li.classList.remove('nav-active')
    menuList[0].classList.add('nav-active')
  }

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


$(function(){
  //轮播图
  layui.use('carousel', function(){
    var carousel = layui.carousel;
    //建造实例
    carousel.render({
      elem: '#swiper',
      width: '100%',
      height:'44.625rem',
      arrow: 'hover',
      // interval:3000,//间隔
      index:0,
      // anim:'fade'

    });
  });

/* 惠家族产品介绍 */
  $('.produtionIntro li').on('click',function(){
    $(this).addClass('chosenProduct').siblings().removeClass('chosenProduct')
  })
})

