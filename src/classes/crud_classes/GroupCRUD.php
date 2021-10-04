<?php

namespace MyApp\classes\crud_classes;
use \MyApp\classes\ConnDB;
use \MyApp\interfaces\CRUD;

class GroupCRUD implements CRUD{
    private $conn;
    public function __construct(ConnDB $conn)
    {
        $this->conn = $conn->connect();
    }
    public function create()
    {
        $sql = "INSERT INTO users VALUES(null,:group_name);";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function read()
    {
        $sql = "SELECT groups.group_id, groups.group_name, roles.role_name, users.name, users.lastname 
                FROM ((groups LEFT JOIN users ON groups.group_id = users.group_id) 
                LEFT JOIN roles ON users.role_id = roles.role_id) WHERE groups.group_id = :group_id ORDER BY groups.group_id ASC;";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function update()
    {
        $sql = "UPDATE groups
                SET groups.group_name = :group_name  
                WHERE groups.group_id = :group_id;";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function delete()
    {
        $sql = "DELETE FROM groups WHERE groups.group_id = :group_id;";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}

// //test
// $test = new CommentCRUD(new ConnDB);
// print_r($test->delete());