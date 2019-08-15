<?php


namespace app\Controller;




use app\Service\common\Factory;
use core\lib\PDOs;

class Model
{
    /**
     *   生成model
     */
    public function generate(){
        if(!empty($_POST)){
            $factory = new Factory();
            define('FRAMEWORK',$_POST['framework']);
            $res =$factory->doModel($_POST['framework'])->generate($_POST['table_name']);
            $res?back('成功'):back('失败');
        }else{
            $id = $_GET['id'];
            $pdo = PDOs::getInstance($id);
            $schema = $pdo->dbName;
            $res =$pdo->query('select table_name from information_schema.tables where table_schema="'.$schema.'"
');
            $work = PDOs::getInstance()->table('work')->where('id='.$id)->one();

            $vendor = [
                'data'=>$res,
                'work'=>$work
                ];
            return view('generate',$vendor);
        }

    }

    /**
     * 生成全部
     */
    public function generate_all(){
        $factory = new Factory();
//        foreach ()
        $id = cache('id');
        $obj = PDOs::getInstance($id);
        define('FRAMEWORK',$_POST['framework']);
        //获取数据表
        $pdo = $obj->query("select table_name from information_schema.tables where table_schema= '".$obj->dbName."'");
        foreach ($pdo as $key=>$value){
            $res =$factory->doModel($_POST['framework'])->generate($value['table_name']);
        }

//        $res?back('成功'):back('失败');
    }

}
