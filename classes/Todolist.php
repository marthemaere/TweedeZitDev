<?php
include_once(__DIR__ ."/Db.php");
 class Todolist {
    private $listname;
    private $id;
   

    public function getListname()
    {
        return $this->listname;
    }

    
    public function setListname($listname)
    {
        if(empty($listname)){
            throw new Exception("Fill in listname");
        }
        $this->listname = $listname;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function save(){
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into list (listname) values (:listname)");
        $query->bindValue(":listname", $this->listname);
        $query->execute();
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from list");
        $query->execute();
        $lists=$query->fetchAll(PDO::FETCH_ASSOC);
        return $lists;
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