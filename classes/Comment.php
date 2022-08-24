<?php
include_once(__DIR__."/Db.php");

class Comment{
    private $text;
    private $task_id;
    private $user_id;
    

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of task_id
     */ 
    public function getTask_id()
    {
        return $this->task_id;
    }

    /**
     * Set the value of task_id
     *
     * @return  self
     */ 
    public function setTask_id($task_id)
    {
        $this->task_id = $task_id;

        return $this;
    }


    /**
     * Get the value of user_id
     */ 
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

    public function add(){
        $conn = Db::getConnection();
        $query=$conn->prepare("insert into comment (text, user_id, task_id) values (:text, :user_id, :task_id)");
        $text = $this->getText();
        $task_id = $this->getTask_id();
        $user_id = $this->getUser_id();
        $query->bindValue(":text", $text);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":task_id", $task_id);

        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}