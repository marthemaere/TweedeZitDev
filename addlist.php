<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');


    if(!empty($_POST)){
        try{
        $list = new Todolist();
        if(isset($_SESSION['user_id'])){
            $list->setUser_id($_SESSION['user_id']);
        } else{
            $list->setUser_id(1);
        }
        $list->setTitle($_POST["title"]);
        
        $list->save();
        header("location: index.php");
        }catch(Throwable $error){
            $error =$error->getMessage();
        }
    }




?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="style.css">
    <title>Make a list</title>
</head>
<body>
    <div class="page">
    <a href="todolist.php"><img class="rounded float-end" src="./images/cross.png" alt="x"></a>
    <?php if(isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form class="makelist" action="" method="post">
        <label for="title" class="form-label" >Add title</label>
        <input type="text" class="form-control" name="title" id="title">
        <div>
        <input type="submit" class="btn btn-primary" value="Make list">
        </div>
    </form>
    </div>
</body>
</html>