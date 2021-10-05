<?php
namespace MyApp\classes\apis;

use MyApp\classes\ConnDB;
use MyApp\interfaces\Request;
use MyApp\classes\crud_classes\CommentCRUD;
require_once '../../vendor/autoload.php';

class CommentApi implements Request{
    private $crud;
    public function __construct(CommentCRUD $cc)
    {
        $this->crud = $cc;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if(!isset($data->comment) || !isset($data->mentor_id) || !isset($data->intern_id)){
            return "not set";
        }
        if ($this->crud->check_mentor($data->intern_id,$data->mentor_id)) {
            $stmt = $this->crud->create();
            $stmt->bindParam(':comment', $data->comment);
            $stmt->bindParam(':mentor_id', $data->mentor_id);
            $stmt->bindParam(':intern_id', $data->intern_id);
            $stmt->execute();
        }
    }
    public function get()
    {
        if(!isset($_GET['intern_id'])){
            return "not set";
        }
        $stmt = $this->crud->read();
        $stmt->bindParam(':intern_id', $_GET['intern_id']);
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
        if(!isset($data->comment_text) || !isset($data->comment_id)){
            return "not set";
        }
        $stmt = $this->crud->update();
        $stmt->bindParam(':comment_text', $data->comment_text);
        $stmt->bindParam(':comment_id', $data->comment_id);
        $stmt->execute();

    }
    public function delete()
    {
        if(!isset($_GET['comment_id'])){
            return "not set";
        }
        $stmt = $this->crud->delete();
        $stmt->bindParam(':comment_id', $_GET['comment_id']);
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
$test = new CommentApi(new CommentCRUD(new ConnDB()));
print_r($test->getRequest());