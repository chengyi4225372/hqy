window.onload = function () {
// 导航栏样式切换
    let menuList = document.querySelectorAll('.header_content ul li')
    console.log(menuList);
    menuList.forEach((item, index) => {
        item.onmouseover = function (event) {
            let li = document.getElementsByClassName('nav-active')[0]
            li.classList.remove('nav-active')
            item.classList.add('nav-active')
        }

        item.onmouseout = function (event) {
            item.classList.remove('nav-active')
            menuList[0].classList.add('nav-active')
        }
    })
}