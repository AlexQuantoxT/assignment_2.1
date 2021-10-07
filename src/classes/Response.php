<?php

namespace MyApp\classes;

class Response{
    private $success = 'success';
    private $failed  = 'request failed';
    public function getResponseSuccess(){
        http_response_code(200);
        return json_encode($this->success);
    }
    public function getResponseFailed($message = ''){
        http_response_code(400);
        return json_encode($this->failed . ' ' . $message);
    }
    public function checkStatus($status){
        if($status){
            return $this->getResponseSuccess();
        }else{
            return $this->getResponseFailed();
        }
    }
}