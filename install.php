<?php

if(!empty($_POST)){
    switch ($_POST['type']){
        case 'info':
           try{
            set_time_limit(5);
               $dsn = 'mysql:host=' . $_POST['ip'] . ';dbname=' . $_POST['database'];
               $db= new PDO($dsn, $_POST['username'],$_POST['password']);
           }catch (Exception $exception){
                echo '数据库信息错误';exit;
           }
           echo "连接成功";
           $db->query(
               <<<TEXT
CREATE TABLE `databae` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `framework` varchar(255) NOT NULL,
  `app_path` varchar(255) NOT NULL,
  `database_username` varchar(255) NOT NULL,
  `db_menu_name` varchar(255) NOT NULL COMMENT 'sys_menu',
  `database_password` varchar(255) NOT NULL,
  `back_name` varchar(255) NOT NULL,
  `application` varchar(255) NOT NULL,
  `controller_namespace` varchar(255) DEFAULT NULL,
  `models_path` varchar(255) DEFAULT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `min_name` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `view_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
TEXT
);
           $db->query('');
           $db =null;
            $path = 'config/database.php';
            $insert = '<?php return ['.PHP_EOL.
                '"ip"=>"'.$_POST['ip'].'",'.
                '"database"=>"'.$_POST['database'].'",'.PHP_EOL.
                '"username"=>"'.$_POST['username'].'",'.PHP_EOL.
                '"password"=>"'.$_POST['password'].'",'.PHP_EOL.
                '"port"=>"'.$_POST['port'].'"'.PHP_EOL.'];';
            file_put_contents($path,$insert);
            break;
    }

    /*
     * 创建系统自有的数据库
     */
    header("location:/");
}

?>
<html>
<body>
<form action="" method="post">
    <input type="hidden" name="type" value="info" >
    <label>数据库地址：</label><input name="ip"><br>
    <label>数据库：</label><input name="database"><br>
    <label>数据库帐号：</label><input name="username"><br>
    <label>数据库密码：</label><input name="password"><br>
    <label>端口：</label><input name="port">
    <input type="submit">
</form>
</body>
</html>
