<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/opt/web/hui-/public/../application/home/view/login/login.html";i:1573461357;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/static/spirit/css/base.css">
  <link rel="stylesheet" href="/static/spirit/css/login.css">
  <script src='/static/spirit/js/login.js'></script>
  <script src="/static/assets/plugins/layui/layui.all.js"></script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="/static/common/js/jquerySession.js"></script>
</head>

<body>

  <div class='login_container'>
    <div class='login_header'>
      <div class='header'>
        <div class="header_content">
          <div class='logo'>
            <a href="<?php echo url('/home/index/index'); ?>"></a>
          </div>
          <div class='a_href'>
            <a href="<?php echo url('/home/index/index'); ?>">返回首页>></a>
          </div>
        </div>
      </div>
      <div id="login_url" data-url="<?php echo url('/home/index/getInfo'); ?>"></div>
      <div id="login_url2" data-url="<?php echo url('/home/index/index'); ?>"></div>
      <div id="login_url3" data-url="<?php echo url('/home/spirit/informationlist'); ?>"></div>
      <div id="login_url4" data-url="<?php echo url('/home/index/infoList'); ?>"></div>
      <div id="check_url" data-url="<?php echo url('/home/login/savetoken'); ?>"></div>
      <div class='login_content'>
        <div class='login_xin'>
          <div class='login_box'>
            <div class='login_title'>欢迎登录惠灵工账号</div>
            <div class='change_style' id='change'>
              <span class='account_login'>账号登录</span>
              <i class='ge'></i>
              <span class='phone active'>手机登录</span>
            </div>
            <div class='user_info' id='userInfo'>
              <div class='phone_user'>
                <div class='accout_name'>
                  <span class='userName'>用户名</span>
                  <input type="text" placeholder="请输入注册手机号" class='accout_input'>
                </div>
                <div class='password'>
                  <span class='u_pass'>密码</span>
                  <input type="password" placeholder="请输入密码" class='pass_input'>
                </div>
                <div class='goRegister'>
                  <span>还没有账号?</span>
                  <a href="<?php echo url('/home/login/register',['id' => $data_id,'type' => $web_type]); ?>">去注册</a>
                </div>
                <button data-id="<?php echo $data_id; ?>" web_type="<?php echo $web_type; ?>" onclick="login_module.account_login_info(this)">登录</button>
              </div>
              <div class='phone_user'>
                <div class='phone_box'>
                  <select name="" id="" class='select'>
                    <option value='+86'>+86</option>
                  </select>
                  <i></i>
                  <input type="text" placeholder="请输入手机号" class='phone_input' id="phone_input" value="">
                </div>
                <div class='code_box'>
                  <input type="text" placeholder="验证码" class='code_input'>
                  <i></i>
                  <span class='huo_code' onclick="login_module.get_code(this)">获取验证码</span>
                  <span class="huo_code" id="msg_code" style="display:none;">60秒后重新获取</span>
                </div>
                <div class='goRegister'>
                  <span>还没有账号?</span>
                  <a href="<?php echo url('/home/login/register',['id' => $data_id,'type' => $web_type]); ?>">去注册</a>
                </div>
                <button data-id="<?php echo $data_id; ?>" web_type="<?php echo $web_type; ?>" onclick="login_module.phone_login_info(this)">登录</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>