<?php
    include_once('core/autoload.php');

    $list_id = $_GET["list_id"];
    $list = Todolist::getListArrayById($list_id);

    if($list["user_id"] != $_SESSION["user_id"]){
        header("location: index.php");
    }

    Task::deleteTask($_GET["task"]);
    header("location: index.php");
    ?>