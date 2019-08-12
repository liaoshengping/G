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

}
