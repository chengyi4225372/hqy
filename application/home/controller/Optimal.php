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
     * @DESC：合伙人
     * @author: jason
     * @date: 2019-11-07 02:59:23
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * @DESC：惠优税
     * @author: jason
     * @date: 2019-12-17 04:53:42
     */
    public function cooperation()
    {
        return $this->fetch();
    }
}