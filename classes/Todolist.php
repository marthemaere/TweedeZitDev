<?php
include_once(__DIR__ ."/Db.php");
 class Todolist {
    private $listname;
   

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
 }