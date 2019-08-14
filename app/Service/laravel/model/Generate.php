<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/8/11
 * Time: 14:52
 */

namespace app\Service\laravel\model;


use app\Service\common\Base;
use app\Service\common\Interfaces\gennerateInterface;
use core\lib\PDOs;
use Liaosp\Tool\String\Character;

class Generate extends Base implements gennerateInterface
{
    public $attribute;
    public $functions;
    public $query;
    public $table_name;
    public $convert_name;
    public $cloumn_list;

    public function generate($table_name, $id = '')
    {
        if (empty($id)) {
            $id = cache('id');
        }
        $obj = PDOs::getInstance($id);
        //获取数据表
        $pdo = $obj->query("select
COLUMN_NAME as name,COLUMN_COMMENT as comment
            FROM INFORMATION_SCHEMA.COLUMNS
where
table_schema = '" . $obj->dbName . "'
 and table_name = '" . $table_name . "'");
        $this->table_name = $table_name;
        $this->convert_name = Character::convertUnderline($this->table_name);
        $this->cloumn_list = $pdo;
        $this->detail($pdo);
    }

    public function detail($data)
    {
        //生成模型
        $this->attribute($data);
        foreach ($data as $key => $value) {
            $this->query .= $this->query($value['name']);
            $this->functions .= $this->functions($value);
        }
        $this->finish();
    }

    public function finish()
    {
        //你要渲染的框架
        $render_data =[
            'base_namespace'=>'',
            'model_namespace'=>'',
            'attribute'=>$this->attribute,
            'functions'=>$this->functions,
            'query'=>$this->query,
            'table_info'=>$this->table_name,
            'convert_name'=>$this->convert_name,
            'cloumn_list'=>$this->cloumn_list,
        ];
        //生成base
        generate('model/base/modelQuery.php',$this->app_path.$this->models_path.'/base/'.$this->convert_name.'Query.php',$render_data,'');
        //生成model
        generate('model/model.php',$this->app_path.$this->models_path.'/'.$this->convert_name.'.php',$render_data,'');
        exit;
    }

    /**
     * 属性
     */
    public function attribute($data)
    {
        $attribute = '';
        $query = '';
//        $attribute .='
//        '.PHP_EOL."const IS_DELETE =1;" . PHP_EOL;
//        $attribute .= "const NOT_DELETE =0;" . PHP_EOL;

        foreach ($data as $key => $value) {
            $attribute .= $this->handleComment($value);
        }
        $this->attribute .= $attribute;
    }

    /**
     * 生成函数
     */
    public function functions($obj)
    {   $data ='';
        $obj_name = $obj['name'];
        $Obj_Bname = Character::convertUnderline($obj_name);
        $data .= '
        /**
        * 获取一条数据条件：'.$obj_name.'
        * @param $'.$obj_name.'
        * @return mixed
        */
        ';
        $data .= 'public static function getOneBy' . $Obj_Bname . '($' . $obj_name . ')
        {
            return static::getOneByFind(static::findBy' . $Obj_Bname . '($' . $obj_name . '));

        }' . PHP_EOL;
        $data .= '
        /**
        * 获取列表条件：'.$obj_name.'
        * @param $'.$obj_name.'
        * @return mixed
        */
        ';
        $data .= 'public static function getListBy' . $Obj_Bname . '($' . $obj_name . ')
        {
            return static::getOneByFind(static::findBy' . $Obj_Bname . '($' . $obj_name . '));

        }' . PHP_EOL;
        return $data;
    }

    /**
     * 查询类
     * @param $obj_name
     * @return string
     */
    public static function query($obj_name)
    {
        $data ='';
        $Obj_Bname = Character::convertUnderline($obj_name);
        $data .= '
        /**
        * 查询条件：'.$obj_name.'
        * @param $'.$obj_name.'
        * @return Builder
        */
        ';
        $data.= 'public static function findBy' . $Obj_Bname . '($' . $obj_name . ')
        {
            return static::query()->where(["' . $obj_name . '"=>$' . $obj_name . ']);
        }' . PHP_EOL;
        return $data;
    }

    /**
     * 处理 属性
     */
    public function handleComment($value)
    {
        // 备注:1.备货中,2.发货
//        if(strstr($value['comment'],':')){
//            echo '存在';
//        }
        if (strstr($value['comment'], ':') && strstr($value['comment'], ',') && strstr($value['comment'], '.')) {
            $exp = explode(':', $value['comment']);
            if (empty($exp[1])) {
                return '';
            }
            $parameter = $exp[1];
            $exp = explode(',', $parameter);
            $content = '';
            $name = strtoupper($value['name']);
            $arr = PHP_EOL;
            //1.备货中
            foreach ($exp as $key => $value) {
                $exp2 = explode('.', $value);
//                    $arr.="'".$exp2[0]."'=>'".$exp2[1]."'";
                $arr .= "'" . $exp2[0] . "'=>'" . $exp2[1] . "';" . PHP_EOL;
            }
            return PHP_EOL . "const $name = [
                  " . $arr . PHP_EOL . "];";
        }


        // 1.备货中,2.发货
        if (strstr($value['comment'], ',' && strstr($value['comment'], '.'))) {
            $exp = explode(',', $value['comment']);
            $content = '';
            $name = strtoupper($value['name']);
            $arr = '';
            //1.备货中
            foreach ($exp as $key => $value) {
                $exp2 = explode('.', $value);
                $arr .= "'" . $exp2[0] . "'=>'" . $exp2[1] . "'";
            }
            return "const $name = [
                  " . $arr . "
                ];";
        }
        return '';
    }
}
