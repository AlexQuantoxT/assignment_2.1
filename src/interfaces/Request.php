<?php
namespace MyApp\interfaces;

/** 
*
* Interface for request functions
*
*/

interface Request{
    /** 
    *
    * For processing post request
    *
    */
    public function post();
    /** 
    *
    * For processing get request
    *
    */
    public function get();
    /** 
    *
    * For processing patch request
    *
    */
    public function patch();
    /** 
    *
    * For processing delete request
    *
    */
    public function delete();
}