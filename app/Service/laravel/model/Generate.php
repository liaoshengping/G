<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/8/11
 * Time: 14:52
 */

namespace app\Service\laravel\model;


use app\Service\common\Interfaces\gennerateInterface;
use core\lib\PDOs;
use Liaosp\Tool\String\Character;

class Generate implements gennerateInterface
{
    public $attribute;
    public $functions;
    public $query;
    public $table_name;
    public function generate($table_name,$id='')
    {
//        echo $id;exit;
       if (empty($id)){
           $id = cache('id');
       }
       $obj =  PDOs::getInstance($id);
       $pdo = $obj->query("select
COLUMN_NAME as name,COLUMN_COMMENT as comment
            FROM INFORMATION_SCHEMA.COLUMNS
where
table_schema = '" . $obj->dbName . "'
 and table_name = '".$table_name."'");
        $this->table_name = $table_name;
       $this->detail($pdo);
    }
    public function detail($data){
        //生成模型
        $this->attribute($data);
        foreach ($data as $key=>$value){
            $this->query.=$this->query($value['name']);
            $this->functions.=$this->functions($value);
        }
        echo $this->attribute.PHP_EOL;

        echo $this->functions;
        echo $this->query;
        exit;
    }

    /**
     * 属性
     */
    public function attribute($data){
        $attribute ='';
        $query ='';
        $attribute .="const IS_DELETE =1;".PHP_EOL;
        $attribute .="const NOT_DELETE =0;".PHP_EOL;

        foreach ($data as $key=>$value){
            $attribute.=$this->handleComment($value);
        }
        $this->attribute.=$attribute;
    }

    /**
     * 生成函数
     */
    public function functions($obj){
        $obj_name = $obj['name'];
        $Obj_Bname = Character::convertUnderline($obj_name);
        $data =  'public static function getOneBy'.$Obj_Bname.'($'.$obj_name.')
        {
            return $this->getOneByFind($this->findBy'.$Obj_Bname.'($'.$obj_name.'))
           
        }'.PHP_EOL;

        $data.=  'public static function getListBy'.$Obj_Bname.'($'.$obj_name.')
        {
            return $this->getOneByFind($this->findBy'.$Obj_Bname.'($'.$obj_name.'))
           
        }'.PHP_EOL;
        return $data;
    }

    /**
     *  查询
     */
//    public function findByUserId($userId)
//    {
//        $this->andWhere(['[[user_id]]' => $userId]);
//        return $this;
//    }
    public static function query($obj_name){
        $Obj_Bname = Character::convertUnderline($obj_name);
        $data =  'public function findBy'.$Obj_Bname.'($'.$obj_name.')
        {
            $this->andWhere(["'.$obj_name.'"=>$'.$obj_name.']);
            return $this;
        }'.PHP_EOL;
        return $data;
    }
    /*
     * 处理 属性
     */
    public function handleComment($value){
        // 备注:1.备货中,2.发货
//        if(strstr($value['comment'],':')){
//            echo '存在';
//        }
            if(strstr($value['comment'],':') && strstr($value['comment'],',') && strstr($value['comment'],'.')){
                $exp=explode(':',$value['comment']);
                if(empty($exp[1])){
                    return '';
                }
                $parameter =$exp[1];
                $exp = explode(',',$parameter);
                $content= '';
                $name =strtoupper($value['name']);
                $arr = PHP_EOL;
                //1.备货中
                foreach ($exp as $key=>$value){
                    $exp2 = explode('.',$value);
//                    $arr.="'".$exp2[0]."'=>'".$exp2[1]."'";
                    $arr.="'".$exp2[0]."'=>'".$exp2[1]."';".PHP_EOL;
                }
                return PHP_EOL."const $name = [
                  ".$arr.PHP_EOL."];";
            }


        // 1.备货中,2.发货
            if(strstr($value['comment'],','&& strstr($value['comment'],'.'))){
                $exp = explode(',',$value['comment']);
                $content= '';
                $name =strtoupper($value['name']);
                $arr = '';
                //1.备货中
                foreach ($exp as $key=>$value){
                    $exp2 = explode('.',$value);
                    $arr.="'".$exp2[0]."'=>'".$exp2[1]."'";
                }
                return "const $name = [
                  ".$arr."
                ];";
            }
            return '';
    }
}
