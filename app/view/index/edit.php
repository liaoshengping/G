<head>
    <title>
        编辑系统
    </title>
</head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
    <h2>编辑系统</h2>
<form class="form-group" method="post" action="/index/edit">
    <?php
    foreach ($data as $key=>$value){
        foreach ($value as $key2=>$value2){
            if($key2 =='id'){
                echo '<label class="label">'.$key2.'</label><input class="form-control" type="hidden" name= "'.$key2.'" value="'.$value2.'" /><br>';
                continue;
            }
            echo '<label class="label">'.$key2.'</label><input class="form-control" type="text" name= "'.$key2.'" value="'.$value2.'" /><br>';
        }
    }
    ?>
    <input type="submit" class="btn btn-primary" value="编辑">

</form>
</div>