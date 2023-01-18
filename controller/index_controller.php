<?php


class IndexController {
    private $smarty;
    public function __construct()
    {
        
    }
    public function index(){
        
       require_once('view/inicio/index.php'); 
        
    }
}