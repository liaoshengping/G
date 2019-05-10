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
 function generate($origin='' , $theTarget='', $render_data=[],$type=''){
     //储存在文件夹，则创建

//     if(is_dir()){
//
//     }
    $render = render($origin,$render_data);
    file_put_contents($theTarget,$render);
}
