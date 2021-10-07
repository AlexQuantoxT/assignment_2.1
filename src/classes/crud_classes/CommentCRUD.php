<?php

namespace MyApp\classes\crud_classes;
use \MyApp\classes\ConnDB;
use MyApp\interfaces\CRUD;
require_once '../../../vendor/autoload.php';
class CommentCRUD implements CRUD{
    private $conn;
    public function __construct(ConnDB $conn)
    {
        $this->conn = $conn->connect();
    }
    public function create()
    {
        $sql = "INSERT INTO comments VALUES(null,:comment,:mentor_id,intern_id,CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function readAll()
    {
        $sql = "SELECT comments.comment_id,comments.comment_text,comments.mentor_id,users.name 
                AS intern_name,users.lastname as intern_lastname,comments.intern_id 
                FROM (comments LEFT JOIN users ON intern_id = users.user_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt;        
    }
    public function read()
    {
        $sql = "SELECT comments.comment_id,comments.comment_text,comments.mentor_id,users.name 
        AS intern_name,users.lastname as intern_lastname,comments.intern_id 
        FROM (comments LEFT JOIN users ON intern_id = users.user_id) WHERE comment_id = :comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function update()
    {
        $sql = "UPDATE comments 
                SET comments.comment_text = :commetn_text,comments.comment_time = CURRENT_TIMESTAMP 
                WHERE comments.comment_id = comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function delete()
    {
        $sql = "DELETE FROM comments WHERE comments.comment_id = :comment_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}
// //test
// $test = new UserCRUD(new ConnDB);
// print_r($test->create());