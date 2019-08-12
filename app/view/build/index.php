<head>
    <title>
        执行系统
    </title>
</head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
    <h2>执行系统</h2>
<form method="post" action="/build/build/id/<?php echo $_GET['id'] ?>">
    <?php
//        foreach ($data as $key=>$value){
//            echo "<div class='form-group'>";
//            echo '<label class="label">'.$key.'</label><input class="form-control" type="text" name='.$key.' value='.$value.' /><br>';
//            echo "</div>";
//        }
    ?>
    <input type="submit" class="btn btn-primary" value="生成一个数据表对应结构">

</form>
<form method="post" action="/build/init/id/<?php echo $_GET['id'] ?>">
    <?php
    foreach ($data as $key=>$value){
        echo '<input type="hidden" name='.$key.' value='.$value.' />';
    }
    ?>
    <input type="submit" class="btn btn-primary" value="初始化项目">
</form>

<a class="btn btn-primary" href="/model/generate/id/<?php echo $_GET['id'] ?>">生成一个模型</a>
    <br>
    <br>

</div>