<?php
  include_once('logged_in.inc.php');
  include_once('core/autoload.php');
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
            header("Location: index.php?id=".$_POST['list_id']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="page">
    <a href="todolist.php"><img class="rounded float-end" src="./images/cross.png" alt="x"></a>
    <h2>Add a task!</h2>
    <?php if(isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form class="addtaskform" action="" method="post">
        <div class="addinfo">
        <label for="title" class="form-label">Add title</label>
        <input type="text" class="form-control"  name="title" id="title">
        </div><div class="addinfo">
        <label for="hours" class="form-label">Add hours</label>
        <input type="text" class="form-control"  name="hours" id="hours">
        </div><div class="addinfo">
        <label for="deadline" class="form-label">Add deadline</label>
        <input type="date" class="form-control"  name="deadline" id="deadline">
        </div>
        <input type="hidden" name="list_id" value="<?php echo htmlspecialchars( $_GET['list_id'])?>">
        <div class="addinfo">
        <button type="submit" class="btn btn-primary">Add task</button>
        </div>
    </form>
    </div>
</body>
</html>