<?php
namespace MyApp\classes\apis;

use MyApp\classes\crud_classes\GroupCRUD;

class GroupApi{
    private $crud;
    public function __construct(GroupCRUD $gc)
    {
        $this->crud = $gc;
    }
}