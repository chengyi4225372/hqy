<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/7/26
 * Time: 9:48
 */
namespace app\common\model;
use think\Model;

/**
 * Class Menu
 * @package app\common\model
 */
class Menu extends Model
{
    //静态对象
    protected static $readInstance = null;
    //表名
    protected $table='h_menus';
    /**
     * 单例
     * @author lamkakyun
     * @date 2019-04-12 09:47:11
     * @return void
     */
    public static function instance()
    {
        if(!self::$readInstance) self::$readInstance = new self('', '', '');
        return self::$readInstance;
    }
}