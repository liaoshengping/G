<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<form method="post" action="/build/build/id/<?php echo $_GET['id'] ?>">
    <?php
        foreach ($data as $key=>$value){
            echo '<label>'.$key.'</label><input type="text" name='.$key.' value='.$value.' /><br>';
        }
    ?>
    <input type="submit" class="btn btn-primary" value="生成一个数据表对应结构">
</form>
<form>
    <input type="submit" class="btn btn-primary" value="初始化项目">
</form>