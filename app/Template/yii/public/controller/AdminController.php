<?php


namespace backend\controllers;


use app\models\SysMenu;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex(){
        $find=SysMenu::find();
        $res = $find->where(['is_delete'=>0])->asArray()->all();
        $data =$this->getTree($res,0);
        return $this->render('index',['data'=>$data]);
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

}
