<?php


namespace app\Controller;


use core\lib\PDOs;

class Model
{
    /**
     *   生成model
     */
    public function generate(){
        if(!empty($_POST)){
            return view('generate',[]);
        }else{
//            $id = $_GET['id'];
//            $data = PDOs::getInstance()->table('work')->where('id='.$id)->one();
//
            return view('generate',[]);
        }

    }

}
