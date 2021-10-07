<?php
namespace MyApp\interfaces;

/** 
*
* Interface for CRUD functions
*
*/

interface CRUD{
    /** 
    *
    * For preparing create sql query
    *
    */
    public function create();
    /** 
    *
    * For preparing read all sql query
    *
    */
    public function readAll();
    /** 
    *
    * For preparing read sql query
    *
    */
    public function read();
    /** 
    *
    * For preparing update sql query
    *
    */
    public function update();
    /** 
    *
    * For preparing delete sql query
    *
    */
    public function delete();
}