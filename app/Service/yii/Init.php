<?php


namespace app\Service\yii;


class Init
{
    //初始化
    /**
     * 首次生成基础框架
     * @param $app_path
     * @param $sys_data
     */
    public function generate_public(){
        global $table_infos;
        global $sys_data;
        $app_path = $table_infos['app_path'];
        /*
         * 控制器
         */
        generate('public/controller/AdminController.php',$app_path.'/controllers/'.$table_infos["back_name"].'Controller.php',$sys_data);
        generate('public/controller/BaseController.php',$app_path.'/controllers/BaseController.php',$sys_data);
        generate('public/controller/SysMenuController.php',$app_path.'/controllers/SysMenuController.php',$sys_data);
        /*
         * 视图
         */
        generate('public/views/admin/index.php',$app_path.'/views/admin/index.php',$sys_data);
        /*
         * js
         */
        generate('js/admin/index.js',$app_path.$table_infos['js_dir'].'admin/index.js');
        generate('js/common.js',$app_path.$table_infos['js_dir'].'common.js');
        /*
         * 模型
         */
        generate('public/model/BaseModel.php',$app_path.'/models/BaseModel.php',$sys_data);

        /*
         * 后台静态资源
         */
        copydir(APP.'Template/'.FRAMEWORK.'/public/html',$app_path.'/web/html/');
        /*
         * views 公共文件加载js 还有css
         */
        copydir(APP.'Template/'.FRAMEWORK.'/views/common',$app_path.'/views/common');
        die('初始化静态文件成功');
    }
}
