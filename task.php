<?php
    include_once(__DIR__."/classes/Task.php");
    $task_id = $_GET["task"];
    $list = Task::getTaskArrayById($task_id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add a task</title>
</head>
<body>
     <p><?php echo ($task['title']);?></p>
     <p><?php echo ($task['date']);?></p>
     <p><?php echo ($task['hour']);?></p>
</body>
</html>