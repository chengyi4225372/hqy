<?php
namespace app\api\controller;
use think\Controller;
use think\Cookie;
use think\Cache;

/**
 * name：获取token，用户信息
 * Class Api
 * @package app\api\controller
 */
class Login extends Controller
{
    /**
     * @DESC：保存token、用户、电话到缓存里面
     * @author: jason
     * @date: 2019-10-29 11:09:49
     */
    public function savetokens()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(empty($_POST)){
                return json(['status' => 400,'message' => '请确认用户或密码是否正确']);
            }
            $mobile = $_POST['mobile'];
            $token = $_POST['token'];
            $userName = $_POST['userName'];
            $userType = $_POST['userType'];
            Cookie::set('mobile',$mobile);
            Cookie::set('token',$token);
            Cookie::set('userName',$userName);
            Cookie::set('userType',$userType);
            return json(['status' => 200,'message' => '成功']);
        }else{
            return json(['status' => 400,'message' => '请确认用户或密码是否正确']);
        }
    }
}