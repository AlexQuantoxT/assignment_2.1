<?php
namespace MyApp\interfaces;

interface Request{
    public function post();
    public function get();
    public function patch();
    public function delete();
}