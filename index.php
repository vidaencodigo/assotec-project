<?php
/** Zona Horaria */

//cambio
date_default_timezone_set('US/Central');
session_start();

if(!isset($_REQUEST['controller'])){

  require_once "controller/index_controller.php";
  $controller = new IndexController();
  $controller->index();

} else {
  
  $controller=$_REQUEST['controller'];
  $action = $_REQUEST['action'];
  require_once "controller/".$controller."_controller.php";
  $controller = ucwords($controller).'Controller';
  $controller = new $controller;
  call_user_func(array($controller, $action));

}