<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/11/7
 * Time: 15:29
 */
namespace app\home\controller;
use app\common\controller\BaseController;
use think\Cookie;

/**
 * name:会启动首页
 * Class Launch
 * @package app\home\controller
 */
class Launch extends BaseController
{
    /**
     * @DESC：惠企动首页
     * @author: jason
     * @date: 2019-11-07 03:30:50
     */
    public function index(){
        return $this->fetch();
    }
}