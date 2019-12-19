<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/10/29
 * Time: 11:32
 */
namespace app\common\controller;
use think\Config;
use think\Controller;
use think\Cookie;
use think\Hook;

/**
 * Class前台页面公共类
 * @package app\common\controller
 */
class BaseController extends Controller
{
    /**
     * 用户信息
     */
    protected $userinfo = '';


    protected $base_urls = '';


    /**
     * @DESC：初始化
     * @author: jason
     * @date: 2019-10-29 11:35:04
     */
    public function _initialize()
    {
        $mobile = Cookie('mobile');

        $token = Cookie('token');
        $userName = Cookie('userName');
        $userType = Cookie('userType');
        $mobile = !empty($mobile) ? $mobile :'';
        $token = !empty($token) ? $token : '';
        $userName = !empty($userName) ? $userName : '';
        $userType = !empty($userType) ? $userType : '';
        $userInfo = [];

        $userInfo['mobile'] = $mobile;
        $userInfo['token'] = $token;
        $userInfo['userName'] = $userName;
        $userInfo['userType'] = $userType;
        $this->userinfo = $userInfo;
        $SOFTWARE = $_SERVER['SERVER_SOFTWARE'];
        $is_nginx = stripos($SOFTWARE,'nginx');
        if($is_nginx !== false){
            $is_nginx = '';
        }else{
            $is_nginx = '/index.php';
        }
        $this->base_urls = Config::get('curl.redirect_url');
        $login_url = Config::get('curl.login_url');

        $modulename = $this->request->module();
        $controllername = strtolower($this->request->controller());
        $actionname = strtolower($this->request->action());

        // 当前路径
        $path = '/'.$modulename . '/' . str_replace('.', '/', $controllername) . '/' . $actionname;
        $this->assign('path',$path);
        $this->assign('is_nginx',$is_nginx);
        $this->assign('baseurl',$login_url);
        $this->assign('userinfo',$userInfo);
    }
}