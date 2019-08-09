<?php
/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/8
 * Time: 15:15
 */
/**
 * @param string $origin 源头
 * @param string $theTarget 目标
 * @param array $render_data 渲染数据s
 */
function generate($origin = '', $theTarget = '', $render_data = [], $type = '')
{
    //储存在文件夹，则创建
    $dir = dirname($theTarget);
    if (!is_dir($dir)) {
        mkdir($dir, 0777,1);
    }
    $render = render($origin, $render_data);
    file_put_contents($theTarget, $render);
}
function alert($msg='我是提示',$url='/'){
    $script='';
    $script.= '<body><script>';
    $script.= 'alert("'.$msg.'");';
    $script.= 'window.location.href="'.$url.'";reload();';
    $script.= '</script></body>';
    echo $script;exit;
}
function back($msg='失败',$url='/'){
    $script='';
    $script.= '<body><script>';
    $script.= 'alert("'.$msg.'");';
    $script.= 'window.history.go(-1);reload();';
    $script.= '</script></body>';
    echo $script;exit;
}
