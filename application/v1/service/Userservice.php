<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/10/21
 * Time: 8:37
 */
namespace app\v1\service;
use app\common\model\Admin;
use plugin\Tree;
use plugin\Crypt;
use think\Cache;
use think\Config;
/**
 * Class Userservice
 * @package app\v1\service
 */
class Userservice
{
    // 静态对象
    protected static $instance = null;
    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-07-26 10:00:16
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    /**
     * @DESC：用户列表
     * @author: jason
     * @date: 2019-10-21 08:39:08
     */
    public function getList($params)
    {

        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : 20;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : 1;
        //分页起始值
        $start = $page_size * ($current_page - 1);

        $where = [];

        if(isset($params['username']) && !empty($params['username'])){
            //将中文逗号替换成英文逗号
            if(strpos($params['username'],'，')){
                $params['username'] = str_replace('，',',',$params['username']);
            }
            //将空格替换成英文逗号
            $params['username'] = preg_replace('/\s{1,}/',' ',$params['username']);
            $params['username'] = str_replace(' ',',',$params['username']);
            $params['username'] = explode(',',$params['username']);

            $params['username'] = array_filter($params['username'],function ($params){
                return !empty($params);
            });
            $userArr = array_map(function($par){
                return '%'.$par.'%';
            },$params['username']);

            $where['username'] = ['LIKE',$userArr,'OR'];
        }
        if(isset($params['status']) || $params['status'] != ''){
            $where['is_del'] = $params['status'];
        }

        //分页url参数
        $config = [
            'query' => request()->param(),
        ];
        $userInfo = Admin::where($where)
            ->limit($start,$page_size)
            ->order('id', 'desc')
            ->paginate($page_size, false, $config);
        $page = $userInfo->render();

        $return_data = [
            'list' => $userInfo->toArray(),
            'page' => $page,
        ];

        return $return_data;
    }




    /**
     * @DESC：添加用户
     * @author: jason
     * @date: 2019-10-21 10:12:02
     */
    public function adduser($params)
    {
        $username = $params['username'];
        $password = $params['password'];
        $tel = $params['tel'];
        $mail = $params['mail'];
        if(empty($username)){
            return json(['status' => false,'msg' => '用户名不能为空']);
        }
        if(empty($password)){
            return json(['status' => false,'msg' => '密码不能为空']);
        }
        if(empty($tel)){
            return json(['status' => false,'msg' => '电话不能为空']);
        }
        if(empty($mail)){
            return json(['status' => false,'msg' => '邮箱不能为空']);
        }

        $userInfo = Admin::where(['username' => $username])->find();
        if(!empty($userInfo)){
            return json(['status' => false,'msg' => '用户已存在']);
        }
        $add['username'] = $username;
        $add['password'] = md5(md5($password));
        $add['tel'] = $tel;
        $add['mail'] = $mail;
        $res = Admin::insertGetId($add);
        if(empty($res)){
            return json(['status' => false,'msg' => '添加用户失败']);
        }


        return json(['status' => true,'msg' => '添加用户成功']);
    }

    /**
     * @DESC：获取编辑用户信息
     * @author: jason
     * @date: 2019-10-21 10:57:47
     */
    public function getEditUserInfo($id)
    {
        if(empty($id)){
            echo '<div style="color:red;">用户不存在</div>';die();
        }
        $where['id'] = $id;
        $userInfo = Admin::where($where)->find()->toArray();
        if(empty($userInfo)){
            echo '<div style="color:red;">用户不存在</div>';die();
        }
        return $userInfo;
    }

    /**
     * @DESC：编辑用户信息
     * @author: jason
     * @date: 2019-10-21 11:15:14
     */
    public function edituser($params)
    {
        //数据校验
        if(!isset($params['id']) || empty($params['id']))return json(['status' => false,'msg' => '用户不存在']);
        if(!isset($params['username']) || empty($params['username']))return json(['status' => false,'msg' => '用户不存在']);
        if(!isset($params['tel']) || empty($params['tel']))return json(['status' => false,'msg' => '电话不能为空']);
        if(!isset($params['mail']) || empty($params['mail']))return json(['status' => false,'msg' => '邮箱不能为空']);
        $userInfo = Admin::where(['id' => $params['id']])->find();
        if(empty($userInfo))return json(['status' => false,'msg' => '用户不存在']);
        $save['username'] = $params['username'];
        $save['tel'] = $params['tel'];
        $save['mail'] = $params['mail'];

        $where['id'] = $params['id'];
        Admin::update($save,$where);
        return json(['status' => true,'msg' => '修改用户信息成功']);
    }

    /**
     * @DESC：用户数量
     * @return int|string
     * @author: jason
     * @date: 2019-10-31 10:01:56
     */
    public function usercount()
    {
        $user = Admin::where(['is_del' => 0])->count();
        return $user;
    }
}