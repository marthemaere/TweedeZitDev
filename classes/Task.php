<?php
include_once(__DIR__."/Db.php");
class Task{
    private $id;
    private $title;
    private $hours;
    private $deadline;
    private $list_id;

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

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

    /**
     * Get the value of hours
     */ 
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set the value of hours
     *
     * @return  self
     */ 
    public function setHours($hours)
    {
        if(empty($hours)){
        throw new Exception("Fill in expected workhours");
        }
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get the value of deadline
     */ 
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set the value of deadline
     *
     * @return  self
     */ 
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function save(){
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into task (title, hours, deadline, list_id) values (:title, :hours, :deadline, :list_id)");
        $query->bindValue(":title", $this->title);
        $query->bindValue(":hours", $this->hours);
        $query->bindValue(":deadline", $this->deadline);
        $query->bindValue(":list_id", $this->list_id);
        $query->execute();
    }

    
    public function getList_id()
    {
        return $this->list_id;
    }

    public function setList_id($list_id)
    {
        $this->list_id = $list_id;

        return $this;
    }

    public static function getTaskArrayById($id){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from task where id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllById ($list_id){
        $conn  =Db::getConnection();
        $query=$conn->prepare("select * from task where list_id = :list_id");
        $query->bindValue(':list_id', $list_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTaskById($id){
        $conn = Db::getConnection();
        $query=$conn->prepare("select*from task where id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        $taskArray = $query->fetch(PDO::FETCH_ASSOC);

        $task = new self();
        $task->setList_id($taskArray["list_id"]);
        $task->setId($taskArray["id"]);
        $task->setTitle($taskArray["title"]);
        $task->setHours($taskArray["hours"]);
        $task->setDeadline($taskArray["deadline"]);

        return $task;

    }
}