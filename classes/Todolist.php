<?php
include_once(__DIR__ ."/Db.php");
 class Todolist {
    private $id;
    private $title;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

   

    public function gettitle()
    {
        return $this->title;
    }

    
    public function settitle($title)
    {
        if(empty($title)){
            throw new Exception("Fill in title");
        }
        $this->title = $title;

        return $this;
    }


    public function save(){
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into list (title) values (:title)");
        $query->bindValue(":title", $this->title);
        $query->execute();
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from list");
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