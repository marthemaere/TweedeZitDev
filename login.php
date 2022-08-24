<?php
include_once('core/autoload.php');
session_start();

if(isset($_SESSION["logged_in"])){
  header("location: index.php");
}

if(!empty($_POST)){
    try{
        $user = new User();
        if($_POST['email']){
            $user->setEmail($_POST['email']);
            $email = $user->getEmail();
        }
        
        $user->setPassword($_POST['password']);
        $password = $user->getPassword();

        if($user->canLogin($email, $password)){
            $_SESSION['user'] = $user->findByEmail($email);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id']= User::getIdByEmail($email);
            header("Location: index.php");
        }
    } catch (Throwable $error){
        $error = $error->getMessage();
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
    <link rel="stylesheet" href="style.css">
    <title>Log in</title>
</head>
<body>
<form action="" method="post">
<div class="page">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <?php if(isset($error)): ?>
  <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Log in</button>
  <p>No account yet? <a href="register.php">click here!</a> </p>
</form>
</div>
</body>
</html>
    
</body>
</html>