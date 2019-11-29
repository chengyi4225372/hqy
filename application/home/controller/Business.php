<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/11/7
 * Time: 15:21
 */
namespace app\home\controller;
use app\common\controller\BaseController;
use think\Cookie;

/**
 * name: 惠创业首页
 * Class Business
 * @package app\home\controller
 */
class Business extends BaseController
{
    public function index(){
        return $this->fetch();
    }
}