<?php echo '<?php'?>


namespace app\models;


class BaseModel extends \yii\db\ActiveRecord
{
    protected $page;
    protected $pageSize;
    function __construct($config = [])
    {
        parent::__construct($config);
        $this->page= \Yii::$app->request->get('page',1);
        $this->pageSize= \Yii::$app->request->get('pageSize',10);
    }

}
