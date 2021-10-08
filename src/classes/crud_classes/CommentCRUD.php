<?php

namespace MyApp\classes\crud_classes;
use \MyApp\classes\ConnDB;
use MyApp\interfaces\CRUD;

class CommentCRUD implements CRUD{
    private $conn;
    public function __construct(ConnDB $conn)
    {
        $this->conn = $conn->connect();
    }
    public function create()
    {
        $sql = "INSERT INTO comments VALUES(null,:comment,:mentor_id,:intern_id,CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function readAll()
    {
        $sql = "SELECT comments.comment_id,comments.comment_text,comments.comment_time,comments.mentor_id,users.name 
                AS intern_name,users.lastname as intern_lastname,comments.intern_id 
                FROM (comments LEFT JOIN users ON intern_id = users.user_id) ORDER BY comments.comment_time DESC";
        $stmt = $this->conn->prepare($sql);
        return $stmt;        
    }
    public function read()
    {
        $sql = "SELECT comments.comment_id,comments.comment_text,comments.comment_time,comments.mentor_id,users.name 
        AS intern_name,users.lastname as intern_lastname,comments.intern_id 
        FROM (comments LEFT JOIN users ON intern_id = users.user_id) WHERE comment_id = :comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function update()
    {
        $sql = "UPDATE comments 
                SET comments.comment_text = :comment_text,comments.comment_time = CURRENT_TIMESTAMP 
                WHERE comments.comment_id = :comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function delete()
    {
        $sql = "DELETE FROM comments WHERE comments.comment_id = :comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    //comparing Intern and Mentor group
    public function check_mentor($intern_id,$mentor_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = :intern_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':intern_id', $intern_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach($stmt as $value){
                $intern_group_id = $value['group_id'];
            }
        }else{
            $intern_group_id = "";
        }
        
        $sql = "SELECT * FROM users WHERE user_id = :mentor_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':mentor_id', $mentor_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach($stmt as $value){
                $mentor_group_id = $value['group_id'];
            }
        }else{
            $mentor_group_id = "";
        }
        
        if ($intern_group_id === $mentor_group_id) {
            return true;
        }else{
            return false;
        }
    }
}