<?php
    include_once(__DIR__."/classes/Todolist.php");
    include_once(__DIR__."/classes/Task.php");
    $list_id=$_GET['id'];
    $list = Todolist::getListArrayById($list_id); 

    $tasks = Task::getAllById($list_id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div>
        <h1>To Do's</h1>
        <div class="task">
            <a href="addtask.php?list_id=<?php echo $list_id; ?>">Add new to-do task</a>
        </div>

        <table class="table">
            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <a data-task-id="<?php echo $task['id']?>"href="">taskdone</a>
                    <a href="task.php?task=<?php echo $task['id']; ?>"><?php echo $task['title'];?></a>
                    <p><?php echo $task['deadline']; ?></p>
                    <p><?php echo $task['hours']; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($tasks)): ?>
                <p>no task found</p>
            <?php endif; ?>
        </table>
    
    </div>
</body>
</html>