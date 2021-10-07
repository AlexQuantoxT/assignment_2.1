<?php
namespace MyApp\apis;

use MyApp\classes\ConnDB;
use MyApp\classes\crud_classes\GroupCRUD;
use MyApp\interfaces\Request;

require_once '../../vendor/autoload.php';

class GroupApi implements Request{
    private $crud;
    public function __construct(GroupCRUD $gc)
    {
        $this->crud = $gc;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if(!isset($data->group_name)){
            return "not set";
        }
        // return $data->group_name;
        $stmt = $this->crud->create();
        $stmt->bindParam(':group_name', $data->group_name);
        $stmt->execute();
    }
    public function get()
    {
        if(!isset($_GET['group_id'])){
            // return "not set";
            $stmt = $this->crud->readAll();
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $key => $value) {
                    $arr['data'][] = $value;
                }
                return json_encode($arr);
            }
        }
        //return $_GET['group_id'];
        $stmt = $this->crud->read();
        $stmt->bindParam(':group_id', $_GET['group_id']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $key => $value) {
                $arr['data'][] = $value;
            }
            return json_encode($arr);
        }
    }
    public function patch()
    {
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if(!isset($data->group_name) || !isset($data->group_id)){
            return "not set";
        }
        // return $data->group_name . " " . $data->group_id;
        $stmt = $this->crud->update();
        $stmt->bindParam(':group_name', $data->group_name);
        $stmt->bindParam(':group_id', $data->group_id);
        $stmt->execute();
    }
    public function delete()
    {
        if(!isset($_GET['group_id'])){
            return "not set";
        }
        //return $_GET['group_id'];
        $stmt = $this->crud->delete();
        $stmt->bindParam(':group_id', $_GET['group_id']);
        $stmt->execute();
    }
    
//See the request
    public function getRequest(){
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            return $this->post();
        } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
            return $this->get();
        } elseif ($_SERVER['REQUEST_METHOD'] === "PATCH") {
            return $this->patch();
        } elseif ($_SERVER['REQUEST_METHOD'] === "DELETE") {
            return $this->delete();
        }
    }
}
//test
$test = new GroupApi(new GroupCRUD(new ConnDB()));
print_r($test->getRequest());