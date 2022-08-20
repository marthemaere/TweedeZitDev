<?php
include_once(__DIR__."/classes/Todolist.php");
include_once(__DIR__."/classes/Task.php");


$lists = Todolist::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>What To Do</title>
</head>
<body>
    <div class="homepage">
        <h1> What To Do?</h1>
        <div class="list">
            <a href="addlist.php">Add new list</a>
        </div>

        <table class="table">
            <h2>To Do lists</h2>

            <?php if(!empty($lists)): ?>
                <?php foreach($lists as $list): ?>
                 <a href="todolist.php?id=<?php echo htmlspecialchars( $list['id']);?>"> <?php echo htmlspecialchars( $list['title']);?></a>
                <?php endforeach; ?>
            <?php endif ?>

            <?php if(empty($lists)): ?>
                <p>No lists</p>
            <?php endif ?>

        </table>
    </div>
</body>
</html>