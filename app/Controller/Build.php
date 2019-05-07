<?php

namespace app\Controller;

use app\Service\Mysql;
use app\Service\yii\Init;
use core\lib\PDOs;

Class Build extends BuildBase {
    protected $sys_data =[];
    public function __construct()
    {
        parent::__construct();
        $this->sys_data = [
            'controller_namespace'=>$this->application.$this->controller_namespace,
            'controller_class_name'=>$this->class_name.'Controller',
            'class_name'=>$this->class_name,
            'site_prefix'=>$this->site_prefix,
            'application_name_path'=>$this->application,
        ];
        global $sys_data;
        $sys_data = $this->sys_data;
    }

    public function build(){
        $have_sys_menu=$this->PDO()->haveTable('sys_menu');
        if(!$have_sys_menu){
            (new Mysql())->buildSysMenu();
            echo "<script>alert('不存在mysql 已经帮您创建数据表sys_menu')</script>";
        }
        $app_path = $this->app_path;//要修改的
        $application = $this->application;//要修改的
        $controller_namespace = $this->controller_namespace;
        $models_path = $this->models_path;
        $class_name = $this->class_name;
        $min_name = $this->min_name;
        $table_name = $this->table_name;
        $view_path =$this->view_path;
        $menu_url = $min_name.'/';
        $controller_name = $class_name.'Controller';//大写
        /*
         * 生成控制器
         */
        $sys_data = $this->sys_data;
        //控制器生成
        $controller =  render('controller/controller.php',$sys_data);
        file_put_contents($app_path.$controller_namespace.'/'.$controller_name.'.php',$controller);

        /*
         * 生成模型
         */
        $table_info['table_info'] =$this->PDO()->table($table_name)->query("select * from information_schema.columns where table_schema = '$this->database_name' and table_name = '$table_name';");
        $sys_data = array_merge($table_info,$sys_data);
        $models=  render('model/model.php',$sys_data);
        file_put_contents($app_path.$models_path.'/'.$class_name.'.php',$models);
        /*
         * 生成视图
         */
        $view = [
            'index',
            'view',
            'create',
            'delete',
            'update',
        ];
        foreach ($view as $views){
            if(in_array($views,$this->post_api)){
                $this->buildMenu($menu_url,$views,$min_name);
                //过滤接口的
                continue;
            }
            $js_dir = $this->js_dir_app.$min_name;
            $sys_data =array_merge($sys_data,['js_dir'=>$js_dir.'/'.$views.'.js']);
            $view_template=  render($view_path.'/'.$views.'.php',$sys_data);
            $view_dir = $app_path.'/'.$view_path.'/'.$min_name;
            if(!is_dir($view_dir)){
                mkdir ($view_dir,0777,true);
            }
            file_put_contents($view_dir.'/'.$views.'.php',$view_template);
            echo '创建'.$view_dir.'/'.$views.'.php'.'成功'.PHP_EOL;
            if($this->build_menu ==true){
                $this->buildMenu($menu_url,$views,$min_name);
            }
            $this->buildJS($app_path,$menu_url,$views,$min_name,$sys_data);
        }

        echo "创建成功";
//        $this->generate_public($app_path,$sys_data);

    }

    /**
     *  建立菜单
     */
    public function buildMenu($paths,$obj,$min_name){
        $if_build = true;
        if($if_build ==false){
            echo "没有开启菜单建立";return false;
        }
        $path = $this->site_prefix.'/'.$paths.$obj;
//        $this->query();
        $menu_db =$this->PDO()->table($this->db_menu_name)->where('url="'.$path.'" and is_delete=0 and is_url = 1')->find();
//        echo $path;exit;
        if($menu_db){
            return true;
        }
        //类的顶级菜单
        $class_info = $this->PDO()->table($this->db_menu_name)->where('class="'.$min_name.'"  and is_url = 0')->find();

        if(!$class_info){
            //创建一个父级
            $pid =$this->PDO()->table($this->db_menu_name)->insert([
                'name'=>$min_name,
                'class'=>$min_name,
                'is_url'=>0,
                'url'=>'/'.$paths.'index',
                'update_time'=>date('Y-m-d H:i:s'),
                'create_time'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $pid=$class_info['id'];
        }
        $menu_insert=[
            'name'=>$this->name_zn[$obj],
            'url'=>$path,
            'pid'=>$pid,
            'is_hide'=>in_array($obj,$this->post_api)?1:0,
            'update_time'=>date('Y-m-d H:i:s'),
            'create_time'=>date('Y-m-d H:i:s')
        ];
        $this->PDO()->insert($menu_insert);
//        var_dump($data);exit;
    }
    /*
     * 新建js文件
     */
    public function buildJS($app_path,$paths,$obj,$min_name,$sys_data){
        //判断js 文件夹是否存在
        $js_dir = $app_path.$this->js_dir.$min_name;
        if(!is_dir($js_dir)){
            mkdir ($js_dir,0777,true);
        }
        $sys_data = array_merge($sys_data,['mini_name'=>$min_name]);
        $js_template=  render('js/'.$obj.'.js',$sys_data);
        file_put_contents($js_dir.'/'.$obj.'.js',$js_template);
        echo $js_dir.'/'.$obj.'.js'.PHP_EOL;
    }




    public function PDO(){
     return PDOs::getInstance($_POST['host'],$_POST['database_username'],$_POST['database_password'],$_POST['database_name'],'utf8');
    }
    public function index(){
        $id = $_GET['id'];
        $data =PDOs::getInstance()->table('work')->where('id='.$id)->find();
        $render = ['id'=>$id,'data'=>$data];
        return view('index',$render);
    }

    /**
     * 初始化系统
     */
    public function init(){
        (new Init())->generate_public();
    }



}






