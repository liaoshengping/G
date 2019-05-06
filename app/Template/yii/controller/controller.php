<?php echo '<?php'?>


namespace <?php echo $controller_namespace?>;
use app\models\<?php echo $class_name?>;
Class <?php echo $controller_class_name?> extends BaseController{

    public function actionIndex(){
        if(\Yii::$app->request->get('page')){
            $data = (new <?php echo $class_name?>())->getList();
            return $this->success($data);
        }else{
            return $this->render('index');
        }
    }
    public function actionUpdate(){
        if(\Yii::$app->request->post()){
        }else{
        return $this->render('update');
        }
    }
    public function actionCreate(){
        if($post_data =\Yii::$app->request->post()){
            if(!empty($post_data['id'])){
                //更新
            $id = $post_data['id'];
            unset($post_data['id']);
            unset($post_data['_csrf']);
            $res = (new <?php echo $class_name?>())->updateData(['id'=>$id],$post_data);
            if($res){
            return $this->success($res);
                }else{
                //新增
            return $this->error();
                }
        }else{
        return $this->render('create');
        }
    }
}
    public function actionView(){
        if(\Yii::$app->request->post()){
        $id = \Yii::$app->request->post('id',0);
        $data = (new <?php echo $class_name?>())->getInfoById(['id'=>$id]);
        echo json_encode(['code'=>200,'result'=>$data]);
        }else{
        return $this->render('view');
        }
    }
    public function actionDelete(){
    if(\Yii::$app->request->post()){
    $id = \Yii::$app->request->post('id',0);
    $res = (new <?php echo $class_name?>())->updateData(['id'=>$id],['is_delete'=>1]);
    if($res){
    return $this->success($res);
    }else{
    //新增
    return $this->error();
    }
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

