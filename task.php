<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');
    $task_id = $_GET["task"];
    $list = Task::getTaskArrayById($task_id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>add a task</title>
</head>
<body>
    <div class="page">
    <a href="todolist.php"><img class="rounded float-end" src="./images/cross.png" alt="x"></a>
     <input type="text" class="form-control" id="commentText" placeholder="Leave a comment">
     <button class="btn btn-primary" id="btnAddComment" data-task_id="<?php echo $task['id']?>">add comment</button>
     <p><a href="deletetask.php?task=<?php echo $_GET["task"]; ?>">delete task</a></p>
     </div>
     <script src="app.js"></script>
</body>
</html>