<?php

include_once(__DIR__ ."/Db.php");

class User{
    private $email;
    private $username;
    private $password;

    

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        if(empty($email)){
            throw new Exception("Email cannot be empty");
        }
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    
    public function setPassword($password)
    {
        if( empty($password)){
            throw new Exception("Password can not be empty");
        } else if (strlen($password)<8){
            throw new Exception("Your password must be at least 8 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.");
        }
        $this->password = $password;

        return $this;
    }

    public function register(){
        $options = [
            'cost' => 12,
          ];
        
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into account (email, password) values (:email, :password)");
        $query->bindValue(":email", $this->email);
        $query->bindValue(":password", $password);
        $query->execute();
    }

    public function canLogin($email, $password){
        $conn = Db::getConnection();
        $query = $conn->prepare("select * from account where email =:email");
        $query->bindValue(":email", $email);

        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if(!$user){
            throw new Exception("No matching account, please try again");
            return false;
        }

        $hash = $user["password"];
        if (password_verify($password, $hash)){
            return true;
        } else {
            throw new Exception("Password is incorrect.");
            return false;
        }

        return $this;
    }

    public function findByEmail($email){
        $conn = Db::getConnection();
        $query = $conn->prepare("select * from account where email =:email");
        $email = htmlspecialchars($email);
        $query->bindValue(":email", $email);

        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user){
            return $user;
        } else{
            return false;
        }
    }

    public function checkEmail($email){
        $conn = Db::getConnection();
        $query=$conn->prepare("select * from account where email = :email");
        $query->bindValue(":email", $email);
        $query->execute();

        $user=$query->fetch(PDO::FETCH_ASSOC);

        if($user){
            throw new Exception("This email is already used");
        }
    }

    public function checkusername($username){
        $conn = Db::getConnection();
        $query=$conn->prepare("select * from account where username = :username");
        $query->bindValue(":username", $username);
        $query->execute();

        $user=$query->fetch(PDO::FETCH_ASSOC);

        if($user){
            throw new Exception("This username is already used");
        }
    }

    public static function getUserById(int $id){
            $conn = Db::getConnection();
            $query=$conn->prepare("select * from account where id = :id");
            $query->bindValue(":id", $id);
            $query->execute();
    
            return $query->fetch(PDO::FETCH_ASSOC);
    
    }

    public static function deleteAccount($id, $password){
            $conn = Db::getConnection();
            $query=$conn->prepare("select * from account where id = :id");
            $query->bindValue(":id", $id);
            $query->execute();

            $user = $query->fetch(PDO::FETCH_ASSOC);
            $hash = $user['password'];

            if(password_verify($password, $hash)){
                $conn = Db::getConnection();
                $query=$conn->prepare("delete from account where id = :id");
                $query->bindValue(":id", $id);
                $query->execute();
    
                session_destroy();
                session_reset();
                header("location :login.php");
            } else{
                throw new Exception("password incorrect");
            }
    }
}
