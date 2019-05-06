<?php echo '<?php';?>



namespace <?php echo $application_name_path ?>\controllers;
use app\models\SysMenu;
use yii\helpers\Json;
use yii\web\Controller;
Class SysMenuController extends BaseController{

    public function actionIndex(){
        if(\Yii::$app->request->get('page')){
        $data = (new <?php echo $class_name?>())->getList();
        return $this->success($data);
        }else{
        return $this->render('index');
        }
    }
    public function actionMenu(){
        if(\Yii::$app->request->post()){
        $find=SysMenu::find();
        $res = $find->where(['is_delete'=>0])->asArray()->all();
        $data =[
        'code'=>200,
        'result'=>$this->getTree($res,0),
        ];
        echo json_encode($data);exit;
        }
    }
    function getTree($data, $pId=0)
    {
        $tree = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pId) {
                $v['children_arr'] = $this->getTree($data, $v['id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }
    public function actionUpdate(){
        if(\Yii::$app->request->post()){
        }else{
        return $this->render('update');
        }
    }
    public function actionCreate(){
        if(\Yii::$app->request->post()){
        }else{
        return $this->render('create');
        }
    }
    public function actionView(){
        if(\Yii::$app->request->post()){
        $id = \Yii::$app->request->post('id',0);
        $data = (new SysMenu())->getInfoById(['id'=>$id]);
        echo json_encode(['code'=>200,'result'=>$data]);
        }else{
        return $this->render('view');
        }
    }
    /*
    获取表结构
    */
    public function actionInfo(){
        if(\Yii::$app->request->post()){
        $table = (new <?php echo $class_name?>())->table_info;
        return $this->success($table);
        }
    }

}



