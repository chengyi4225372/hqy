<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2020/1/3
 * Time: 9:10
 */
namespace app\mobile\controller;

use app\mobile\service\Apiservice;
use think\Controller;
use think\Request;
use think\config;
class Apiport extends Controller
{
    protected $token1 = '';
    protected $token2 = '';

    /**
     * @DESC：初始化
     * @author: jason
     * @date: 2020-01-03 09:40:49
     */
    public function _initialize()
    {
        $token = Config::get('token.tokens');
        $result = Request::instance()->header('Authorization');

        $token1 = md5(md5($token));
        $token2 = !empty($result) ? md5(md5($result)) : '';
        $this->token1 = $token1;
        $this->token2 = $token2;
    }

    /**
     * @DESC：获取惠享产品信息
     * @author: jason
     * @date: 2020-01-03 09:15:19
     */
    public function getproduct()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");

        //验证token
        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);

        $tokens1 = md5(md5($this->token1));
        $tokens2 = md5(md5($this->token2));
        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $info = Apiservice::instance()->getProduct();
        if(empty($info)) return json(['code' => 400,'message' => '没有找到需要的数据']);
        return json(['code' => 200,'data' => $info,'message' => '获取数据成功']);
    }

    /**
     * @DESC：查询出两条招标的数据
     * @author: jason
     * @date: 2020-01-03 02:23:15
     */
    public function gettwobiao()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //验证token
        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);

        $tokens1 = md5(md5($this->token1));
        $tokens2 = md5(md5($this->token2));
        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $biaoInfo = Apiservice::instance()->gettwobiao(1);
        $shangInfo = Apiservice::instance()->gettwobiao(2);
        $biao = !empty($biaoInfo) ? $biaoInfo : '';
        $shang = !empty($shangInfo) ? $shangInfo : '';
        return json(['code' => 200,'biao' => $biao,'shang' => $shang,'message' => '获取数据成功']);
    }

    /**
     * @DESC：获取惠家族产品列表
     * @author: jason
     * @date: 2020-01-03 04:33:09
     */
    public function getfamily()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //验证token
        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);

        $tokens1 = md5(md5($this->token1));
        $tokens2 = md5(md5($this->token2));
        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $info = Apiservice::instance()->getfamily();
        return json(['code' => 200,'data' => $info,'message' => '获取数据成功']);
    }

    /**
     * @DESC：获取招标信息详情
     * @author: jason
     * @date: 2020-01-06 09:22:16
     */
    public function getbaioinfo()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //验证token
        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);

        $tokens1 = md5(md5($this->token1));
        $tokens2 = md5(md5($this->token2));
        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if(empty($id)) return json(['code' => 400,'message' => '没有要找的招标信息详情']);
        $info = Apiservice::instance()->getbaioinfo(['id' => $id]);
        if(empty($info)) return json(['code' => 400,'message' => '没有搜索到您要查询的数据']);
        return json(['code' => 200,'message' => '已找到相关数据','data' => $info]);
    }

    /**
     * @DESC：获取招商信息
     * @author: jason
     * @date: 2020-01-06 10:09:47
     */
    public function getshanginfo()
    {
        //允许跨域
        header("Access-Control-Allow-Origin:*");
        //验证token
        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);

        $tokens1 = md5(md5($this->token1));
        $tokens2 = md5(md5($this->token2));
        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if(empty($id)) return json(['code' => 400,'message' => '没有要找的招标信息详情']);
        $info = Apiservice::instance()->getbaioinfo(['id' => $id]);
        if(empty($info)) return json(['code' => 400,'message' => '没有搜索到您要查询的数据']);
        return json(['code' => 200,'message' => '已找到相关数据','data' => $info]);
    }

    /**
     * @DESC：招标查看更多
     * @author: jason
     * @date: 2020-01-06 11:05:30
     */
    public function getmorebiao()
    {

    }
}