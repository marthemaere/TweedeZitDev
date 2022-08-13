<?php
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

    /**
     * Set the value of password
     *
     * @return  self
     */ 
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
        $conn = new PDO("mysql:host=localhost:8889;dbname=todo", 'root', 'root');
        $query = $conn->prepare("insert into account (email, password) values (:email, :password)");
        $query->bindValue(":email", $this->email);
        $query->execute();
        $user = ($query->fetch());

        $options = [
              'cost' => 12,
            ];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
            $query = $conn->prepare("insert into account (email, password) values (:email, :password)");
            $query->bindValue(":email", $this->email);
            $query->bindValue(":password", $password);
            $query->execute();
            return true;
    }
}
