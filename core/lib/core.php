<?php
function view($name,array $data =[])
{
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
    }
    $route = new \core\lib\Route();
    $controller = $route->controller;
    $path = APP . 'view/' . strtolower($controller) . '/' . $name . '.php';
    if (!is_file($path)) {
        die('缺少视图文件' . $path);
    }
    include_once($path);
}

/**
 *  页面渲染
 */
function render($name, array $data = [])
{
    /*
     * 赋值
     */
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
    }
    $path = APP . 'Template/' . FRAMEWORK . '/' . $name;
    if (!is_file($path)) {
        die('没有找到视图文件' . $path);
    }
//    echo "kkk";exit;
//    echo $name.PHP_EOL;
    ob_start();
    require_once($path);
    $ob_content = ob_get_contents();
    ob_clean();
    return $ob_content;
}

/**
 * 复制文件夹
 * @param $source
 * @param $dest
 */
function copydir($source, $dest)
{
    if (!file_exists($dest)) mkdir($dest);
    $handle = opendir($source);
    while (($item = readdir($handle)) !== false) {
        if ($item == '.' || $item == '..') continue;
        $_source = $source . '/' . $item;
        $_dest = $dest . '/' . $item;
        if (is_file($_source)) copy($_source, $_dest);
        if (is_dir($_source)) copydir($_source, $_dest);
    }
    closedir($handle);
}
