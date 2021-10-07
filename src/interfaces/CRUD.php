<?php
namespace MyApp\interfaces;

interface CRUD{
    public function create();
    public function readAll();
    public function read();
    public function update();
    public function delete();
}