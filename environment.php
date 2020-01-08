<?php
// +----------------------------------------------------------------------
// | 环境设置文件
// +----------------------------------------------------------------------
// | Author: jason
// +----------------------------------------------------------------------

// 版本判断
//if (PHP_VERSION < 7) {
//    exit('PHP版本过低，请升级PHP版本. (http://www.php.net/downloads.php)') . PHP_EOL;
//}

// +----------------------------------------------------------------------
// | 环境设置  开发环境=development    测试环境=test    生产环境=production
// +----------------------------------------------------------------------


$clientkeywords = array ('nokia', 'sony','ericsson','mot',
    'samsung','htc','sgh','lg','sharp',
    'sie-','philips','panasonic','alcatel',
    'lenovo','iphone','ipod','blackberry',
    'meizu','android','netfront','symbian',
    'ucweb','windowsce','palm','operamini',
    'operamobi','openwave','nexusone','cldc',
    'midp','wap','mobile'
);
//判断是否是手机端
//if(preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
//    define('ENVIRONMENT', 'mobile');
//}else{
//     //生产环境    PC端
//    //define('ENVIRONMENT', 'production');
//}





//开发环境
define('ENVIRONMENT', 'development');

//测试环境

//define('ENVIRONMENT', 'test');

// 配置文件目录
define('CONFIG_PATH', __DIR__ . '/config/' . ENVIRONMENT . '/');

// 应用常量配置文件
require_once sprintf("%sconstant.php", CONFIG_PATH);