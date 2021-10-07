<?php
namespace MyApp\apis;

use MyApp\classes\ConnDB;
use MyApp\classes\crud_classes\GroupCRUD;
use MyApp\interfaces\Request;
use MyApp\classes\Response;

require_once '../../vendor/autoload.php';

class GroupApi extends Response implements Request{
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
            return $this->getResponseFailed('invalid parameters');
        }
        // return $data->group_name;
        $stmt = $this->crud->create();
        $stmt->bindParam(':group_name', $data->group_name);
        $status = $stmt->execute();
        if($status){
            return $this->getResponseSuccess();
        }else{
            return $this->getResponseFailed();
        }
    }
    public function get()
    {
        if(!isset($_GET['group_id'])){
            $stmt = $this->crud->readAll();
            $status = $stmt->execute();
            if ($status) {
                $this->getResponseSuccess();
                if ($stmt->rowCount() > 0) {
                    foreach ($stmt as $key => $value) {
                        $arr['data'][] = $value;
                    }
                    return json_encode($arr);
                }
            }else{
                return $this->getResponseFailed();
            }
            
        }
        $stmt = $this->crud->read();
        $stmt->bindParam(':group_id', $_GET['group_id']);
        $status = $stmt->execute();
        if ($status) {
            $this->getResponseSuccess();
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $key => $value) {
                    $arr['data'][] = $value;
                }
                return json_encode($arr);
            }
        }else{
            return $this->getResponseFailed();
        }
        
    }
    public function patch()
    {
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if(!isset($data->group_name) || !isset($data->group_id)){
            return $this->getResponseFailed('invalid parameters');
        }
        $stmt = $this->crud->update();
        $stmt->bindParam(':group_name', $data->group_name);
        $stmt->bindParam(':group_id', $data->group_id);
        $status = $stmt->execute();
        if ($status) {
            return $this->getResponseSuccess();
        }else{
            return $this->getResponseFailed();
        }
    }
    public function delete()
    {
        if(!isset($_GET['group_id'])){
            return $this->getResponseFailed('invalid parameters');
        }
        $stmt = $this->crud->delete();
        $stmt->bindParam(':group_id', $_GET['group_id']);
        $status = $stmt->execute();
        if ($status) {
            return $this->getResponseSuccess();
        }else{
            return $this->getResponseFailed();
        }
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