<?php


namespace app\Service\common;


use core\lib\PDOs;

class Base
{
    public $app_path;
    public $table_info;
    public $models_path;
    function __construct()
    {
//        echo 'kkk';exit;
        $id = $_GET['id']?$_GET['id']:$_POST['id'];
        $this->table_info =PDOs::getInstance()->table('work')->where('id='.$id)->one();
        if(!empty($this->table_info)){
            define('FRAMEWORK',$this->table_info['framework']);
            $this->app_path = $this->table_info['app_path'];
            $this->models_path = $this->table_info['models_path'];
        }
    }
}
