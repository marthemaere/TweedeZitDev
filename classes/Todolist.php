<?php
include_once(__DIR__ ."/Db.php");
 class Todolist {
    private $id;
    private $user_id;
    private $title;
    private $description;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
   

    public function getTitle()
    {
        return $this->title;
    }

    
    public function setTitle($title)
    {
        if(empty($title)){
            throw new Exception("Fill in title");
        }
        $this->title = $title;

        return $this;
    }

    
    public function getDescription()
    {
        return $this->description;
    }

     
    public function setDescription($description)
    {
        if(empty($description)){
            throw new Exception("Fill in description");
        }
        $this->description = $description;

        return $this;
    }


    public function save(){
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into list ( title, user_id, description) values (:title, :user_id, :description)");
        $query->bindValue(":title", $this->title);
        $query->bindValue(":user_id", $this->user_id);
        $query->bindValue(":description", $this->description);
       
        $query->execute();
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from list");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllForUser($user_id){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from list where user_id = :user_id");
        $query->bindValue(":user_id", $user_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteProject($id){
        $conn = Db::getConnection();
        $query = $conn->prepare("DELETE from list where id=:id");
        $query->bindParam(":id", $id);
        $query->execute();
    }

    public static function getListArrayById($id){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from list where id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public static function checktask($title, $list_id){
        $conn = Db::getConnection();
        $query = $conn->prepare("select count(*) from task where title = :title and list_id = :list_id");
        $query->bindValue(":title", $title);
        $query->bindValue(":list_id", $list_id);
        $query->execute();
        return(int) $query->fetchColumn()>0;
    }


 }