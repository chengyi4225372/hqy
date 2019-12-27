<?php
namespace app\mobile\controller;

use app\v1\service\Workservice;
use think\Controller;
use app\v1\service\Protuctservice;
use app\v1\service\Infosservice;
use app\v1\service\Systems;
use app\v1\service\Caseservice;
use app\v1\service\Ificationservice;
use think\Cookie;
use think\Cache;
class Index extends Controller
{


    public function index()
    {

        $info = infosservice::instance()->getId(42276);
//        echo '<pre>';print_r($info);exit;
        $this->assign('info',$info);
        return $this->fetch();

    }

    /**
     * @DESC：是哪个端进入页面
     * @author: jason
     * @date: 2019-12-26 05:05:19
     */
    public function ismobile()
    {
        $clientkeywords = array ('nokia', 'sony','ericsson','mot',
            'samsung','htc','sgh','lg','sharp',
            'sie-','philips','panasonic','alcatel',
            'lenovo','iphone','ipod','blackberry',
            'meizu','android','netfront','symbian',
            'ucweb','windowsce','palm','operamini',
            'operamobi','openwave','nexusone','cldc',
            'midp','wap','mobile'
        );
        if(preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            echo '<pre>';print_r($_SERVER);exit;
    }
}