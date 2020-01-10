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
        $url = Config::get('queue.url');
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            header('Location:'.$url);exit;
        }
        // 如果via信息含有wap则一定是移动设备
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            if(stristr($_SERVER['HTTP_VIA'], "wap") == true){
                header('Location:'.$url);exit;
            }
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia','sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                header('Location:'.$url);exit;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                header('Location:'.$url);exit;
            }
        }

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



    /**
     * 移动端判断
     */
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia','sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }

}