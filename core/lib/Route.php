<?php
/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/8
 * Time: 18:41
 */

namespace core\lib;


class Route
{
    public $controller='';
    public $action ='';
    function __construct()
    {
       if(isset($_SERVER['REQUEST_URI']) &&$_SERVER['REQUEST_URI'] !=='/' ){
            $path = $_SERVER['REQUEST_URI'];
            $ex = explode('/',trim($path,'/'));//trim 移除字符串两侧的字符，如果不移除会存在空的数组存在。
            if(isset($ex[0])){
                $this->controller = $ex[0];
                unset($ex[0]);
            }else{
                $this->controller = 'index';
            }

            if(isset($ex[1])){
                $this->action =$ex[1];
                unset($ex[1]);
            }else{
                $this->action = 'index';
            }
            $count = count($ex)+2;
            $i =2;
            while ($i<$count){
                if(isset($ex[$i+1])){
                    $_GET[$ex[$i]] = $ex[$i+1];
                }
                $i=$i+2;
            }
       }else{
           $this->controller = 'Index';
           $this->action= 'index';
       }

    }

    public function index(){
        echo "i,m 路由类";
    }
}
