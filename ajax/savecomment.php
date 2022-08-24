<?php
include_once('../core/autoload.php');
session_start();
    if(!empty($_POST)){
        $c = new Comment();
        $c->getTask_id($_POST['task_id']);
        $c->setText($_POST['text']);
        $c->setUser_id($_SESSION['user_id']);

        $id = $c->add();

        $response = [
            'status' => 'success',
            'body' => htmlspecialchars($c->getText()),
            'email' => $_SESSION['email'],
            'id'=>$id,
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

    };


?>