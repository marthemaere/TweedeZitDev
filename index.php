<?php
include_once('logged_in.inc.php');
include_once('core/autoload.php');

$user_id = $_SESSION["user_id"];
$user = User::getUserById($user_id);


$lists = Todolist::getAllForUser($user_id);

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>What To Do</title>
</head>
<body>
    <div class="page">
    <a class="logout" href="logout.php">log out</a>
        <h1> What To Do?</h1>
        <div class="list">
            <a href="addlist.php">Add new list</a>
        </div>

        <table class="table">
            <h2>To Do lists</h2>
            <div class="lists">
            <?php if(!empty($lists)): ?>
                <?php foreach($lists as $list): ?>
                 <a class="lists" href="todolist.php?id=<?php echo htmlspecialchars( $list['id']);?>"> <li><?php echo htmlspecialchars( $list['title']);?></li></a>
                <?php endforeach; ?>
            <?php endif ?>
            </div>

            <?php if(empty($lists)): ?>
                <p>No lists</p>
            <?php endif ?>

        </table>
    </div>
</body>
</html>