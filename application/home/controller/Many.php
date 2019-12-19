<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/11/7
 * Time: 15:14
 */
namespace app\home\controller;
use app\common\controller\BaseController;
use think\Cookie;

/**
 * name:惠多新首页
 * Class Many
 * @package app\home\controller
 */
class Many extends BaseController
{
    public function index(){
        return $this->fetch();
    }
}