<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/7/24
 * Time: 17:04
 */
namespace app\v1\controller;
//use think\Controller;
use app\common\controller\AuthController;
use app\common\model\User;
use app\v1\service\Home;
use app\common\model\Admin;
use app\v1\service\Protuctservice;
use app\v1\service\Infosservice;
use app\v1\service\Userservice;
class Index extends AuthController
{
    /**
     * @DESC：后台首页
     * @author: jason
     * @date: 2019-07-24 05:05:08
     */
    public function index()
    {
        $userId = Cookie('userid');
        //用户信息
        $userInfo = Admin::where(['id' => $userId])->find()->toArray();
        //惠享产品 统计
        $pro_count = Protuctservice::instance()->getproductcount();
        //招标信息统计
        $info_count = Infosservice::instance()->getinfocount();
        //用户信息统计
        $user_count = Userservice::instance()->usercount();
        $this->assign('user_count',!empty($user_count) ? $user_count : 0);
        $this->assign('info_count',!empty($info_count) ? $info_count : 0);
        $this->assign('pro_count',!empty($pro_count) ? $pro_count : 0);


        $this->assign('title','首页');
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }
}