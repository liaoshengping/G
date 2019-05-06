<?php echo '<?php'?>


namespace <?php echo $application_name_path ?>\controllers;


use yii\web\Controller;

class BaseController extends Controller
{
    public function success($data=[],$msg='成功'){
       return json_encode([
           'code'=>200,
           'result'=>$data,
           'msg'=>$msg,
       ]);
    }
    public function error($msg='失败',$data=[]){
        return json_encode([
            'code'=>400,
            'result'=>$data,
            'msg'=>$msg,
        ]);
    }


}
