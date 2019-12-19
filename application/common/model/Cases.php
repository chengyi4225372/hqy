<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class Cases extends Model
{
    //静态对象
    protected static $readInstance = null;
    //表名
    protected $table='h_case';

    /**
     * @DESC：单例
     * @return Slideshow|null
     * @author: jason
     * @date: 2019-10-21 05:28:03
     */
    public static function instance()
    {
        if(!self::$readInstance) self::$readInstance = new self('', '', '');
        return self::$readInstance;
    }
}