<?php
include_once ('core/lib/cache.php');
if(!empty($_POST)){
    switch ($_POST['type']){
        case 'info':
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
