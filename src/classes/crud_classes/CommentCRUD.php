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
        
    }
    public function read()
    {
        
    }
    public function update()
    {
        
    }
    public function delete()
    {
        
    }
}