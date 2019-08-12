<head>
    <title>
       添加系统
    </title>
</head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
<form method="post" action="/index/add">
    <?php
    foreach ($data as $key=>$value){
        echo '<label>'.$value['name'].'</label><input type="text" name='.$value['name'].'  /><br>';
    }
    ?>
    <input type="submit" class="btn btn-primary" value="添加">

</form>
</div>