<?php
/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/8
 * Time: 15:15
 */
//当前目录路径
define('THINKSP', getcwd());
define('CORE', THINKSP . '/core/');
define('APP', THINKSP . '/app/');

define('MODULE', 'app');
define('DEBUG', true);
if ('DEBUG' == true) {
    ini_set('display_error', true);
} else {
    ini_set('display_error', false);
}
include CORE . 'lib/cache.php';
//判断是否安装程序
if (!is_file(THINKSP.'/config/database.php')) {
    header("location:/install.php");
}
//加载公用函数
include CORE . 'common/function.php';
include CORE . 'lib/core.php';
include CORE . 'Thinksp.php';
spl_autoload_register('\core\Thinksp::load');
core\Thinksp::run();



