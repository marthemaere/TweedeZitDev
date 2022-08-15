<?php
    

    if(!empty($_POST)){
      try{ include_once(__DIR__."/classes/User.php");

        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->register();

        session_start();
        $_SESSION['email'] = $user->getEmail();
      } catch(Throwable $error){
        $error=$error->getMessage();
    // $email = $_POST['email'];
    // $options = [
    //   'cost' => 12,
    // ];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    
    // $conn = new PDO("mysql:host=localhost:8889;dbname=todo", 'root', 'root');
    // $query = $conn->prepare("insert into account (email, password) values (:email, :password)");
    // $query->bindValue(":email", $email);
    // $query->bindValue(":password", $password);
    // $query->execute();

    }}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>ToDo</title>
</head>
<body>
<form action="" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <div id="passwordHelpBlock" class="form-text">
    </div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">I agree with terms and conditions</label>
  </div>
  <?php if(isset($error)): ?>
  <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Sign up</button>
</form>
    
</body>
</html>