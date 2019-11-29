<?php
// +----------------------------------------------------------------------
// | 需登录权限校验控制器基类
// +----------------------------------------------------------------------
// | Copyright (c) 2019 http://www.huiqiyun.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kevin
// +----------------------------------------------------------------------

namespace app\common\controller;

use think\Config;
use think\Controller;
use think\Cookie;
use think\Hook;
use think\Lang;

/**
 * 后台控制器基类
 * Class AuthController
 * @package app\common\controller
 */
class AuthController extends Controller
{
    /**
     * 无需登录的方法,同时也就不需要鉴权了
     * @var array
     */
    protected $noNeedLogin = [];

    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    protected $noNeedRight = [];

    /**
     * 布局模板
     * @var string
     */
    protected $layout = '';

    /**
     * 权限控制类
     * @var Auth
     */
    protected $auth = null;

    /**
     * 快速搜索时执行查找的字段
     */
    protected $searchFields = 'id';

    /**
     * 是否是关联查询
     */
    protected $relationSearch = false;

    /**
     * 是否开启数据限制
     * 支持auth/personal
     * 表示按权限判断/仅限个人
     * 默认为禁用,若启用请务必保证表中存在admin_id字段
     */
    protected $dataLimit = false;

    /**
     * 数据限制字段
     */
    protected $dataLimitField = 'admin_id';

    /**
     * 数据限制开启时自动填充限制字段值
     */
    protected $dataLimitFieldAutoFill = true;

    /**
     * 是否开启Validate验证
     */
    protected $modelValidate = false;

    /**
     * 是否开启模型场景验证
     */
    protected $modelSceneValidate = false;

    /**
     * Multi方法可批量修改的字段
     */
    protected $multiFields = 'status';

    /**
     * 导入文件首行类型
     * 支持comment/name
     * 表示注释或字段名
     */
    protected $importHeadType = 'comment';

    /**
     * @var string 是否显示左侧菜单
     */
    protected $adaptive = 'adaptive';

    /**
     * @var int 系统ID
     */
    protected $system_id = 0;

    /**
     * 初始运行
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        //判断是否登录
        $this->isLogin(url('v1/login/index'));
        $modulename = $this->request->module();
        $controllername = strtolower($this->request->controller());
        $actionname = strtolower($this->request->action());

        // 当前路径
        $path = '/'.$modulename . '/' . str_replace('.', '/', $controllername) . '/' . $actionname;
        // 定义是否Dialog请求
        !defined('IS_DIALOG') && define('IS_DIALOG', input("dialog") ? true : false);

        // 定义是否AJAX请求
        !defined('IS_AJAX') && define('IS_AJAX', $this->request->isAjax());



        // 如果有使用模板布局
        if ($this->layout) {
            $this->view->engine->layout('layout/' . $this->layout);
        }
        // 语言检测
        $lang = strip_tags(Lang::detect());
        $site = Config::get("site");

        // 配置信息
        $config = [
            'site' => array_merge($site, array_flip(['name', 'indexurl', 'cdnurl', 'timezone', 'languages'])),
            'modulename' => $modulename,
            'controllername' => $controllername,
            'layout' => IS_DIALOG ? 'layout/dialog' : 'layout/default',
            'moduleurl' => rtrim(url("/{$modulename}", '', false), '/'),
            'language' => $lang,
        ];
        $config = array_merge($config, Config::get("view_replace_str"));
        // 更新访问时间
        Cookie::set('accesstime', time());
        // 配置信息后
        Hook::listen("config_init", $config);
        //加载当前控制器语言包
        $this->loadlang($controllername);
        //渲染站点配置
        $this->assign('site', $site);
        //渲染配置信息
        $this->assign('config', $config);
        // 渲染菜单
//        $this->view->assign('menulist', $menulist);
//        $this->view->assign('navlist', $navlist);
        $SOFTWARE = $_SERVER['SERVER_SOFTWARE'];
        $is_nginx = stripos($SOFTWARE,'nginx');
        if($is_nginx !== false){
            $is_nginx = '';
        }else{
            $is_nginx = '/index.php';
        }
        $this->assign('is_nginx',$is_nginx);
        $this->assign('paths',$path);
        $this->assign('site', $site);
        $this->assign('config', $config);
        $this->assign('request', $this->request);
        $this->assign('userInfo',Cookie::get());
        $this->assign('adaptive', $this->adaptive);
    }

    /**
     * @DESC：是否登录
     * @param $url
     * @author: jason
     * @date: 2019-07-26 05:23:55
     */
    protected function isLogin($url)
    {
        $userInfo = Cookie('username');
        if(empty($userInfo)){
            $this->redirect($url);
        }
    }

    /**
     * 加载语言文件
     * @param string $name
     */
    protected function loadlang($name)
    {
        Lang::load(APP_PATH . $this->request->module() . '/lang/' . Lang::detect() . '/' . str_replace('.', '/', $name) . '.php');
    }

    /**
     * 渲染配置信息
     * @param mixed $name 键名或数组
     * @param mixed $value 值
     */
    protected function assignconfig($name, $value = '')
    {
        $this->view->config = array_merge($this->view->config ? $this->view->config : [], is_array($name) ? $name : [$name => $value]);
    }
}
