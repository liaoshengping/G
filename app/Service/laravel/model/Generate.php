<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/8/11
 * Time: 14:52
 */

namespace app\Service\laravel\model;


use core\lib\PDOs;

class Generate implements gennerateInterface
{

    public function generate($table_name)
    {
       $id = cache('id');
       $obj =  PDOs::getInstance($id);
//       echo $obj->dbName ;exit;
       $pdo = $obj->query("select
                COLUMN_NAME as name 
            FROM INFORMATION_SCHEMA.COLUMNS
where
table_schema = '" . $obj->dbName . "'
 and table_name = '".$table_name."'");

       $this->detail($pdo);
    }
    public function detail($pdo){

    }
}