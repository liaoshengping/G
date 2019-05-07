<?php
namespace app\Controller;

use core\lib\PDOs;

/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/10
 * Time: 21:28
 */
class Index
{
    public function index(){
        $info = PDOs::getInstance()->table('work')->get();
        if(empty($info)){
            die('没有相关数据,请添加');
        }
        $data =[
            'work'=>$info,
        ];
        return view('index',$data);
    }

}
