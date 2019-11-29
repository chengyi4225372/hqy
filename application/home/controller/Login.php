<?php

namespace app\home\controller;

use app\common\controller\BaseController;
use  think\Controller;
use think\Cookie;
use think\Cache;
use think\Config;
class Login extends BaseController
{


    /**
     * @DESC：登录
     * @return mixed
     * @author: jason
     * @date: 2019-11-13 09:33:33
     */
    public function login()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
        } else {
            $id = '0';
        }
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $type = intval($_GET['type']);
        } else {
            $type = '0';
        }
        $this->assign('web_type', $type);
        $this->assign('data_id', $id);
        return $this->fetch();
    }

    public function register()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
        } else {
            $id = '';
        }
        $this->assign('data_id', $id);
        return $this->fetch();
    }


    /**
     * @DESC：保存token、用户、电话到cookie里面
     * @author: jason
     * @date: 2019-10-29 11:09:49
     */
    public function savetoken()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        if ($this->request->isPost() && $this->request->isAjax()) {
            if (empty($_POST)) {
                return json(['status' => false, 'message' => '请确认用户或密码是否正确']);
            }
            $mobile = $_POST['mobile'];
            $token = $_POST['token'];
            $userName = $_POST['userName'];
            $userType = $_POST['userType'];
            Cookie::set('mobile', $mobile);
            Cookie::set('token', $token);
            Cookie::set('userName', $userName);
            Cookie::set('userType', $userType);
            Cache::set($mobile, $mobile);
            return json(['status' => true, 'message' => '登录成功']);
        } else {
            return json(['status' => false, 'message' => '请确认用户或密码是否正确']);
        }
    }

    /**
     * @DESC：保存token、用户、电话到缓存里面
     * @author: jason
     * @date: 2019-10-29 11:09:49
     */
    public function savetokens()
    {
        //惠灵工
        $hlg_url = Config::get('curl.hlg');
        //会找事
        $hzs_url = Config::get('curl.hzs');
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //token
        if (empty($_GET['msg1']) || !isset($_GET['msg1'])) {
            $this->redirect($this->base_urls);
            return;
        }
        //电话
        if (empty($_GET['msg2']) || !isset($_GET['msg2'])) {
            $this->redirect($this->base_urls);
            return;
        }
        //角色
        if (empty($_GET['msg3']) || !isset($_GET['msg3'])) {
            $this->redirect($this->base_urls);
            return;
        }
        $mobile = $_GET['msg2'];
        $token = $_GET['msg1'];
        $userType = $_GET['msg3'];
        Cookie::set('mobile', $mobile);
        Cookie::set('token', $token);
        Cookie::set('userType', $userType);
        $array = [];
        $array['mobile'] = $mobile;
        $array['token'] = $token;
        $array['userType'] = $userType;
//        if($_GET['msg4'] === 'undefined'){
//            echo 333333;exit;
//        }
//        echo "<pre>";print_r($_GET);exit;
//        //请求惠灵工的页面的接口把用户信息带过去
        $res = curl_post($hlg_url.'/home/login/savetokens',$array);
        //把手机号、token、用户类型存到【会找事】页面的cookie里面
        $res2 = curl_post($hzs_url.'/home/login/savetokens',$array);
        if(isset($_GET['msg4']) && !empty($_GET['msg4']) && $_GET['msg4'] !== 'undefined'){
            $this->redirect($_GET['msg4']);
        }
        if ($userType == 'B') {
            $this->redirect($this->base_urls . '/task/task');
        }
        if ($userType == 'C') {
            $this->redirect($this->base_urls . '/personTask/myTask');
        }

    }


    /**
     * @DESC：全局退出
     * @author: jason
     * @date: 2019-11-13 09:24:43
     */
    public function commonlogout()
    {
        //惠灵工
        $hlg_url = Config::get('curl.hlg');
        //会找事
        $hzs_url = Config::get('curl.hzs');
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //是否是退出
        if (empty($_GET['is_logout']) || !isset($_GET['is_logout'])) {
            $this->redirect($this->base_urls);
            return;
        }
        //电话
        if (empty($_GET['mobile']) || !isset($_GET['mobile'])) {
            $this->redirect($this->base_urls);
            return;
        }
        Cookie::clear('mobile');
        Cookie::clear('token');
        Cookie::clear('userType');
        $res = curl_get($hlg_url.'/home/login/apilogout');
        $res2 = curl_get($hzs_url.'/home/login/apilogout');
        $this->redirect($this->base_urls . '/login');
        return;
    }


    /**
     * @DESC：前台退出登录
     * @return \think\response\Json
     * @author: jason
     * @date: 2019-10-31 10:38:54
     */
    public function logout()
    {
        //惠灵工
        $hlg_url = Config::get('curl.hlg');
        //会找事
        $hzs_url = Config::get('curl.hzs');
        if ($this->request->isAjax() && $this->request->isPost()) {
            Cookie::clear('mobile');
            Cookie::clear('token');
            Cookie::clear('userType');
            $res = curl_get($hlg_url.'/home/login/apilogout');
            $res2 = curl_get($hzs_url.'/home/login/apilogout');
            return json(['status' => true, 'message' => '退出登录成功']);
        } else {
            return json(['status' => false, 'message' => '退出登录失败']);
        }
    }

    /**
     * @DESC：其他页面退出那么当前这个页面也要退出
     * @author: jason
     * @date: 2019-11-14 04:14:53
     */
    public function apilogout()
    {
        header("Access-Control-Allow-Origin:*");
        Cookie::clear('mobile');
        Cookie::clear('token');
        Cookie::clear('userType');
        return json(['status' => 200,'message' => 'success']);
    }

}