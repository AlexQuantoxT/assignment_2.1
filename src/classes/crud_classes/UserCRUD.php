<?php

namespace MyApp\classes\crud_classes;
use \MyApp\classes\ConnDB;
use MyApp\interfaces\CRUD;
require_once '../../../vendor/autoload.php';
class UserCRUD implements CRUD{
    private $conn;
    public function __construct(ConnDB $conn)
    {
        $this->conn = $conn->connect();
    }
    public function create()
    {
        $sql = "INSERT INTO users VALUES(null,:user_name,:user_lastname,:role_id,:group_id);";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function read()
    {
        $sql = "SELECT users.user_id,users.name,users.lastname,groups.group_id, groups.group_name,roles.role_name
                FROM ((users LEFT JOIN groups ON users.user_id = groups.group_id)
                LEFT JOIN roles ON users.role_id = roles.role_id) WHERE users.user_id = :user_id ORDER BY users.name ASC;";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function update()
    {
        $sql = "UPDATE users SET users.name = :user_name, users.lastname = :user_lastname, users.role_id = :role_id, users.group_id = :group_id 
                WHERE users.user_id = :user_id;";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function delete()
    {
        $sql = "DELETE FROM users WHERE users.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}

// //test
// $test = new UserCRUD(new ConnDB);
// print_r($test->create());