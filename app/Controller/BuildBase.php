<?php


namespace app\Controller;



class BuildBase
{

    protected $table_infos = [];
    protected $db_menu_name ='sys_menu';
    protected $name_zn =[
        'index'=>'列表',
        'view'=>'查看详情',
        'create'=>'创建',
        'delete'=>'删除',
        'update'=>'更新',
    ];
    protected $post_api =[
        'delete',
        'update',
        'order',//排序
    ];
    protected $application ='';
    protected $app_path = '';//要修改的
    protected $database_name = '';
    protected $js_dir ='';
    protected $js_dir_app ='';
    protected $site_prefix = '';//前缀，有的系统 为 /baiduc.com/home/user/action
    protected $build_menu =true;
    protected $back_name = '';
    protected $controller_namespace ='';
    protected $models_path ='';
    protected $class_name;
    protected $min_name;
    protected $table_name;
    protected $view_path;
    function __construct()
    {
        $id = $_GET['id'];
        if(empty($id)){
            echo '缺少id ，错误';exit;
        }
        if(!empty($_POST)){
            define('FRAMEWORK',$_POST['framework']); //你要渲染的框架
            $this->app_path = $_POST['app_path'];
            $this->database_name = $_POST['database_name'];
            $this->js_dir = $_POST['js_dir'];
            $this->js_dir_app = $_POST['js_dir_app'];
            $this->back_name = $_POST['back_name'];
            $this->application= $_POST['application'];
            $this->controller_namespace = $_POST['controller_namespace'];
            $this->models_path = $_POST['models_path'];
            $this->class_name = $_POST['class_name'];
            $this->table_name = $_POST['table_name'];
            $this->view_path = $_POST['view_path'];
            $this->min_name = $_POST['min_name'];
            $this->table_infos = $_POST;
            global $table_infos;
            $table_infos = $_POST;
        }
    }
}
