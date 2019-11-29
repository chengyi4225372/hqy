<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/11/7
 * Time: 14:57
 */
namespace app\home\controller;
use app\common\controller\BaseController;
use think\Cookie;

/**
 * name: 惠优税
 * Class Optimal
 * @package app\home\controller
 */
class Optimal extends BaseController
{
    /**
     * @DESC：惠优税首页
     * @author: jason
     * @date: 2019-11-07 02:59:23
     */
    public function index(){
        return $this->fetch();
    }
}