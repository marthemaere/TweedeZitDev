<?php
    include_once(__DIR__."/classes/Todolist.php");
    include_once(__DIR__."/classes/Task.php");


    if(!empty($_POST)){
        try{
        $list = new Todolist();
        $list->settitle($_POST['title']);
        
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
    <title>Make a list</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="title"></label>
        <input type="text" name="title" id="title">
        <input type="submit" value="Make list">

        <a href="index.php">Go back</a>
    </form>
</body>
</html>