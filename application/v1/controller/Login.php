<?php
namespace app\v1\controller;
use think\Controller;
use app\v1\service\Systems;
use think\Cookie;
class Login extends Controller
{
    /**
     * 初始化
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * @DESC：登录首页
     * @return mixed
     * @author: jason
     * @date: 2019-07-26 04:26:30
     */
    public function index()
    {
        $this->assign('title','登录');
        return $this->fetch();
    }

    /**
     * 校验登录
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function check()
    {
        if (!$this->request->isPost()) {
            $this->error("请求异常", '/login/index');
        }
        $url = url('v1/index/index');
        $username  = $this->request->post('username');
        $password  = $this->request->post('password');
        //检查用户名跟密码是否正确
        $info = Systems::instance()->checklogin($username,$password);
        if(!$info){
            $this->error(__('Username or password is incorrect'));
        }

        $this->success(__('Login successful'),$url);
    }

    /**
     * @DESC：修改密码
     * @author: jason
     * @date: 2019-07-29 08:30:48
     */
    public function changepass()
    {
        if($this->request->isPost() && $this->request->isAjax()){
            $return_data = Systems::instance()->changepass($_POST);
            if($return_data == false){
                $this->error(__('修改密码失败！'));
            }
            $this->success(__('修改成功!'));
        }
        $userId = Cookie::get('userid');
        if($userId == ''){
            echo '<h3 style="color:red;">用户不存在!!!</h3>';exit;
        }
        $this->assign('username',Cookie::get('username'));
        $this->assign('userid',$userId);
        return $this->fetch();
    }

    /**
     * @DESC：退出登录
     * @author: jason
     * @date: 2019-07-29 01:59:14
     */
    public function logout()
    {
        if(!$this->request->isPost() || !$this->request->isAjax()){
            $this->error(__('请求异常'));
        }
        //销毁session
        Cookie::set('userid','');
        Cookie::set('username','');
        Cookie::set('truename','');
        Cookie::set('tel','');
        Cookie::set('power','');
        Cookie::set('admin','');
        $this->success(__('退出登录成功'),url('v1/login/index'));
    }
}