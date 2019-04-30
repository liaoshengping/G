<?php
function view($name){
    $route =new \core\lib\Route();
    $controller = $route->controller;
    $path =THINKSP.'/app/view/'.strtolower($controller).'/'.$name.'.php';
    if(!is_file($path)){
        die('缺少视图文件'.$path);
    }
    include_once ($path);
}
