<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/8/5
 * Time: 15:34
 */
namespace app\v1\service;

use think\Config;
use app\common\model\Menu;
use plugin\Crypt;
class Home
{
    protected static $instance = null;

    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-08-05 03:48:37
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }




}