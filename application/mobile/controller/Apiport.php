<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2020/1/3
 * Time: 9:10
 */
namespace app\mobile\controller;

header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin');
header('Access-Control-Allow-Headers:content-type,Authorization');
header("Access-Control-Request-Headers:Origin,X-Requested-With,content-Type,Accept,Authorization");

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
        $result = Request::instance()->header('authorization');

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
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

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
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");
        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $biaoInfo = Apiservice::instance()->gettwobiao();
        return json(['code' => 200,'data' => $biaoInfo,'message' => '获取数据成功']);
    }

    /**
     * @DESC：获取惠家族产品列表
     * @author: jason
     * @date: 2020-01-03 04:33:09
     */
    public function getfamily()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");
        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $info = Apiservice::instance()->getfamily();
        return json(['code' => 200,'data' => $info,'message' => '获取数据成功']);
    }

    /**
     * @DESC：获取招标、招商、新闻资讯信息详情
     * @author: jason
     * @date: 2020-01-06 09:22:16
     */
    public function getbaioinfo()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");
        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        if(empty($id)) return json(['code' => 400,'message' => '没有要找的招标信息详情']);
        $info = Apiservice::instance()->getbaioinfo(['id' => $id,'pid' => $pid]);
        if(empty($info)) return json(['code' => 400,'message' => '没有搜索到您要查询的数据']);
        return json(['code' => 200,'message' => '已找到相关数据','list' => ['data' => $info['data'],'prev' => $info['prev'],'next' => $info['next']]]);
    }



    /**
     * @DESC：招标查看更多
     * @author: jason
     * @date: 2020-01-06 11:05:30
     */
    public function getmorebiao()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");



        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $params = $_GET;
        //关键字

        $info = Apiservice::instance()->getmorebiao($params);

        if(empty($info)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','data' => ['data' => $info['data'],'total' => $info['total']]]);
    }

    /**
     * @DESC：招商查看更多
     * @author: jason
     * @date: 2020-01-06 11:05:30
     */
    public function getmoreshang()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $params = $_GET;
        $info = Apiservice::instance()->getmoreshang($params);
        if(empty($info)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','data' => $info]);
    }

    /**
     * @DESC：资讯查看更多
     * @author: jason
     * @date: 2020-01-06 11:05:30
     */
    public function getmoresinformation()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);
        $params = $_GET;
        $info = Apiservice::instance()->getmoresinformation($params);
        if(empty($info)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','data' => $info]);
    }

    /**
     * @DESC：获取招标关键字
     * @author: jason
     * @date: 2020-01-06 09:22:42
     */
    public function getbiaokeyword()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $keyword = Apiservice::instance()->getbiaokey('招标');
        if(empty($keyword)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','keywords' => $keyword]);
    }

    /**
     * @DESC：获取招商关键字
     * @author: jason
     * @date: 2020-01-06 09:22:42
     */
    public function getshangkeyword()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $keyword = Apiservice::instance()->getbiaokey('招商');
        if(empty($keyword)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','keywords' => $keyword]);
    }

    /**
     * @DESC：获取新闻关键字
     * @author: jason
     * @date: 2020-01-06 09:22:42
     */
    public function getnewskeyword()
    {
        //允许跨域
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
            exit;
        }

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        // 响应头设置
        header('Access-Control-Allow-Headers:content-type,token,id');
        header("Access-Control-Request-Headers: Origin, X-Requested-With, content-Type, Accept, Authorization");

        //验证token
//        if(empty($this->token2)) return json(['code' => 400,'message' => 'TOKEN不存在']);
//
//        $tokens1 = md5(md5($this->token1));
//        $tokens2 = md5(md5($this->token2));
//        if($tokens1 != $tokens2) return json(['code' => 400,'message' => 'TOKEN已失效']);

        $keyword = Apiservice::instance()->getbiaokey('新闻');
        if(empty($keyword)) return json(['code' => 400,'message' => '没有找到相关的数据']);
        return json(['code' => 200,'message' => '请求成功','keywords' => $keyword]);
    }
}