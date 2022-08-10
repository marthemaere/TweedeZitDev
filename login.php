<?php

function canLogin($email, $password){
    $conn = new PDO("mysql:host=localhost:8889;dbname=todo", 'root', 'root');
    $statement =$conn->prepare("select * from account where email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();

    $user = $statement->fetch();
    if (!$user){
        return false;
    }

    $hash = $user["password"];
    if (password_verify($password, $hash)){
        return true;
    } else {
        return false;
    }
}

if(!empty($_POST)){
    $email =$_POST['email'];
    $password =$_POST['password'];

    if(canLogin($email, $password)){
        session_start();
        $_SESSION["email"] = $email;
    } else{
        $error = true;
    }

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<form action="" method="post">
  <!-- <div class="alert hidden">That password is incorrect. Please try again!</div> -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <?php if (isset($error)):?>
        <div class="alert">That password is incorrect, try again!</div>
    <?php endif;?>
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <div id="passwordHelpBlock" class="form-text">
      Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Log in</button>
</form>
    
</body>
</html>
    
</body>
</html>