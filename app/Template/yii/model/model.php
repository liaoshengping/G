<?php echo '<?php'?>

namespace app\models;
use Yii;
use yii\data\Pagination;

class <?php echo $class_name ?> extends BaseModel
{
    //如果备注为空，后台前端列表不显示；
    <?php
    echo 'public $table_info = ['.PHP_EOL;
    foreach ($table_info as $key=>$value){
        echo '       "'.$value['COLUMN_NAME'].'"=>"'.$value['COLUMN_COMMENT'].'",'.PHP_EOL;
    }
    echo "    ];";
        ?>



    /*
        获取list数据
    */
    public function getList($where=[]){
        $where_self =[
        'is_delete'=>0
        ];
        $where =array_merge($where_self,$where);
        $find = $this->find();
        $find->where($where);
        $pagination = new Pagination();
        $pagination->setPage($this->page);
        $pagination->setPageSize($this->pageSize);
        $pagination->totalCount = $find->count();
        $find = $find
        ->offset($pagination->getOffset() - $pagination->getPageSize())
        ->limit($pagination->getPageSize());
        $list = $find->asArray()->all();

        return [
        'pagination' => $pagination,
        'list' => $list,
        ];
    }

    /*
        获取一条数据
    */
    public function getInfoById($where=[]){
        $where_self =[
        'is_delete'=>0,
        ];
        $where =array_merge($where_self,$where);
        $find = $this->find();
        $res =$find->where($where)->asArray()->one();
        return $res;
    }

    /*
        更新数据
    */
    public function updateData($where=[],$data){
      return $this->updateAll($data,$where);
    }

}
