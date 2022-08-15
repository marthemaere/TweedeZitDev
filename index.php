<?php
include_once(__DIR__."/classes/Todolist.php");
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
    <h1>Home</h1>
    <a href="todolist.php">add list</a>
    <?php foreach($lists as $list): ?>
        <h2><?php echo $list['listname']?></h2>
    <?php endforeach; ?>
</body>
</html>