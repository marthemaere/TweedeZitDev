<?php
    include_once(__DIR__."/classes/Todolist.php");
    include_once(__DIR__."/classes/Task.php");
    $list_id = $_GET["list_id"];
    $list = Todolist::getListArrayById($list_id);

    if(!empty($_POST)){
        if(Todolist::checktask($_POST["title"], $list_id)==true){
            header("Location: addtask.php?list_id=".$_POST['list_id']);
        }
        try{
            $task = new Task();
            $task->setTitle($_POST['title']);
            $task->setHours($_POST['hours']);
            $task->setDeadline($_POST['deadline']);
            $task->setList_id($_POST['list_id']);

            $task->save();
            header("Location: index.php?list=".$_POST['list_id']);
        } catch(Throwable $error){
            $error=$error->getMessage();
        }
    }
    $lists = Todolist::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <label for="title">Add title</label>
        <input type="text" name="title" id="title">
        <label for="hours">Add hours</label>
        <input type="text" name="hours" id="hours">
        <label for="deadline">Add deadline</label>
        <input type="date" name="deadline" id="deadline">
        <input type="hidden" name="list_id" value="<?php echo htmlspecialchars( $_GET['list_id'])?>">
        <input type="submit" value="Add task">
    </form>
    
</body>
</html>