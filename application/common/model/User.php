<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class User extends Model
{
    //静态对象
    protected static $readInstance = null;
    //表名
    protected $table='users';
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