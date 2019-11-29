<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/8/5
 * Time: 16:41
 */
return array(
    'user' => 'user:info',
    'user_token' => 'rbac:user:token',
    'cache' => [
        // redis连接， 名字不可改
        'redis' => [
            'type' => 'redis',
            'host' => '172.26.3.8',
            'port' => 6379,
            'password' => '',
            'select' => 2,
            'timeout' => 0,
            'expire' => 0,
            'persistent' => false,
            'prefix' => '',
        ],
    ]
);