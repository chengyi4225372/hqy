<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/11/7
 * Time: 15:24
 */
namespace app\home\controller;
use app\common\controller\BaseController;
use think\Cookie;

/**
 * name: 会找事首页
 * Class Searches
 * @package app\home\controller
 */
class Searches extends BaseController
{
    public function index(){
        return $this->fetch();
    }
}