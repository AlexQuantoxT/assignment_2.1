<?php
namespace MyApp\classes\apis;

use MyApp\classes\ConnDB;
use MyApp\interfaces\Request;
use MyApp\classes\crud_classes\UserCRUD;
require_once '../../vendor/autoload.php';

class InternApi implements Request{
    private $crud;
    private $intern = 2;
    public function __construct(UserCRUD $uc)
    {
        $this->crud = $uc;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if(!isset($data->user_name) || !isset($data->user_lastname) || !isset($data->role_id) || !isset($data->group_id)){
            return "not set";
        }
        // return $data->group_name;
        $stmt = $this->crud->create();
        $stmt->bindParam(':user_name', $data->user_name);
        $stmt->bindParam(':user_lastname', $data->user_lastname);
        $stmt->bindParam(':role_id', $data->role_id);
        $stmt->bindParam(':group_id', $data->group_id);
        $stmt->execute();
    }
    public function get(){
        if(!isset($_GET['user_id'])){
            // return "not set";
            $stmt = $this->crud->readAll();
            $stmt->bindParam(':role_id', $this->intern);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $key => $value) {
                    $arr['data'][] = $value;
                }
                return json_encode($arr);
            }
        }
        $stmt = $this->crud->read();
        $stmt->bindParam(':user_id', $_GET['user_id']);
        $stmt->bindParam(':role_id', $this->intern);
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
        if(!isset($data->user_id) || !isset($data->user_name) || !isset($data->user_lastname) || !isset($data->role_id) || !isset($data->group_id)){
            return "not set";
        }
        $stmt = $this->crud->update();
        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->bindParam(':user_name', $data->user_name);
        $stmt->bindParam(':user_lastname', $data->user_lastname);
        $stmt->bindParam(':role_id', $data->role_id);
        $stmt->bindParam(':group_id', $data->group_id);
        $stmt->execute();
    }
    public function delete()
    {
        if(!isset($_GET['user_id'])){
            return "not set";
        }
        $stmt = $this->crud->delete();
        $stmt->bindParam(':user_id', $_GET['user_id']);
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
$test = new InternApi(new UserCRUD(new ConnDB()));
print_r($test->getRequest());