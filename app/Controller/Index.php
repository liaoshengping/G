<?php
namespace app\Controller;

use core\lib\PDOs;
use yii\web\View;

/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/10
 * Time: 21:28
 */
class Index extends Base
{
    public function index(){
        $info = PDOs::getInstance()->table('work')->get();
        $data =[
            'work'=>$info,
        ];
        return view('index',$data);
    }

}
