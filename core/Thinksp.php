<?php
/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/8
 * Time: 15:23
 */
namespace core;


class Thinksp {
    static public function run(){
       $route =new \core\lib\Route();
       $controller = $route->controller;
       $action = $route->action;
       $file = APP.'Controller/'.$controller.'.php';
       $controllerClass = '\\'.MODULE.'\\Controller\\'.$controller;
       if(is_file($file)){
            include $file;
            $class = new $controllerClass();
            $class->$action();
       }else{
            throw new \Exception('找不到控制器'.$controller);
       }
    }
    static public function load($class){
        //自动加载库
        //   core\Route
      $class = str_replace('\\','/',$class);
      $file = THINKSP.'\\'.$class.'.php';
      if(is_file($file)){
          include $file;
      }else{
          return false;
      }
    }
}
