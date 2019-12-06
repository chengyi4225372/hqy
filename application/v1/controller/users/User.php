<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/10/21
 * Time: 8:31
 */
namespace app\v1\controller\users;
use app\common\controller\AuthController;
use app\v1\service\Userservice;
use think\Config;
/**
 * Class user
 * @package app\v1\controller\users
 */
class User extends AuthController
{
    /**
     * @DESC：用户列表
     * @author: jason
     * @date: 2019-10-21 08:34:23
     */
    public function index()
    {
        $status = Config::get('user.status');

        $params = $_GET;
        if(!isset($params['status']) || empty($params['status'])){
            $params['status'] = '';
        }

        if(!isset($params['username']) || empty($params['username'])){
            $params['username'] = '';
        }

        $list = Userservice::instance()->getList($params);
//        echo '<pre>';print_r($params);exit;
        $this->assign('status',$status);
        $this->assign('params',$params);
        $this->assign('data_list',$list['list']['data']);
        $this->assign('title','用户列表');
        return $this->fetch();
    }

    /**
     * @DESC：添加用户
     * @author: jason
     * @date: 2019-10-21 09:32:30
     */
    public function adduser()
    {
        if($this->request->isAjax() && $this->request->isPost()){

            $return_data = Userservice::instance()->adduser($_POST);
            return $return_data;
        }
        return $this->fetch();
    }

    public function edituser()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $return_data = Userservice::instance()->edituser($_POST);
            return $return_data;
        }
        $id = $_GET['id'];
        $return_data = Userservice::instance()->getEditUserInfo($id);
        $this->assign('data',$return_data);
        return $this->fetch();
    }

    /**
     * @DESC：排序
     * @return \think\response\Json
     * @author: jason
     * @date: 2019-12-05 02:25:19
     */
    public function userstatus()
    {
        if($this->request->isPost() && $this->request->isAjax()){
            $return_data = Userservice::instance()->userstatus($_POST);
            if($return_data == false){
                return json(['status' => 400,'msg' => '请确认操作是否正确']);
            }
            return json(['status' => 200,'msg' => '操作成功']);
        }
    }


}