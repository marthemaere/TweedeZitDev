<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');
    $list_id=$_GET['id'];
    $list = Todolist::getListArrayById($list_id); 

    if($list["user_id"]!=$_SESSION["user_id"]){
        header("Location:index.php");
    }

    $tasks = Task::getAllById($list_id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <div class="page">
        <a href="index.php"><img class="cross" src="./images/cross.png" alt="x"></a>
        <h1>To Do's</h1>
        <h2><?php echo htmlspecialchars($list['title']);?></h2>
        <p class="description"><?php echo htmlspecialchars($list['description']); ?></p>
        <div class="task">
            <a class="maketask" href="addtask.php?list_id=<?php echo $list_id; ?>">Add new to-do task</a>
        </div>

        <table class="table">
            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <a data-task-id="<?php echo htmlspecialchars( $task['id'])?>"href=""><img class="images" src="./images/uncheck.png" alt="o"></a>
                    <div class="taskinfo">
                    <a class="tasktitle" href="task.php?task=<?php echo htmlspecialchars( $task['id']); ?>"><?php echo htmlspecialchars( $task['title']);?></a>
                    <p>deadline: <?php echo htmlspecialchars( $task['deadline']); ?></p>
                    <p><?php echo htmlspecialchars( $task['hours']); ?> hours</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($tasks)): ?>
                <p>no task found</p>
            <?php endif; ?>
        </table>
    
    </div>
    <script src="check.js"></script>
</body>
</html>