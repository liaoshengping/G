<?php

namespace app\Controller;

use app\Service\Mysql;
use core\lib\PDOs;

Class Build extends BuildBase {

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
        $sys_data = [
            'controller_namespace'=>$application.$controller_namespace,
            'controller_class_name'=>$controller_name,
            'class_name'=>$class_name,
            'site_prefix'=>$this->site_prefix,
            'application_name_path'=>$application,
        ];
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
        $this->generate_public($app_path,$sys_data);

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

    /**
     * 首次生成基础框架
     * @param $app_path
     * @param $sys_data
     */
    public function generate_public($app_path, $sys_data){

        /*
         * 控制器
         */
        $this->generate('public/controller/AdminController.php',$app_path.'/controllers/'.$this->back_name.'Controller.php',$sys_data);
        $this->generate('public/controller/BaseController.php',$app_path.'/controllers/BaseController.php',$sys_data);
        $this->generate('public/controller/SysMenuController.php',$app_path.'/controllers/SysMenuController.php',$sys_data);
        /*
         * 视图
         */
        $this->generate('public/views/admin/index.php',$app_path.'/views/admin/index.php',$sys_data);
        /*
         * js
         */
        $this->generate('js/admin/index.js',$app_path.$this->js_dir.'admin/index.js');
        $this->generate('js/common.js',$app_path.$this->js_dir.'common.js');
        /*
         * 模型
         */
        $this->generate('public/model/BaseModel.php',$app_path.'/models/BaseModel.php',$sys_data);

        /*
         * 后台静态资源
         */
        copydir(APP.'Template/'.FRAMEWORK.'/public/html',$this->app_path.'/web/html/');
        /*
         * views 公共文件加载js 还有css
         */
        copydir(APP.'Template/'.FRAMEWORK.'/views/common',$this->app_path.'/views/common');

    }

    /**
     * @param string $origin 源头
     * @param string $theTarget 目标
     * @param array $render_data 渲染数据
     */
    public function generate($origin='' , $theTarget='', $render_data=[],$type=''){
        $render = render($origin,$render_data);
        file_put_contents($theTarget,$render);
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

}






