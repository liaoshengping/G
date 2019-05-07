<?php echo '<?php'?>


namespace <?php echo $application_name_path ?>\controllers;////



use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}
