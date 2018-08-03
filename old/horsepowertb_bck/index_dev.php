<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once (__DIR__ . '/Config/routing.php');
include_once (__DIR__ . '/Config/conf_dev.php');
include_once (__DIR__ . '/Controller/AbstractController.php');

if(isset($_SERVER['REQUEST_URI']) && in_array($_SERVER['REQUEST_URI'], array_keys($routes))){
    $route = $routes[$_SERVER['REQUEST_URI']];
    require_once ($route['file']);
    $controller = new $route['class'];
    if($controller instanceof AbstractController){
        $controller->index();
    } else {
        include(__DIR__ . "/Views/404NotFound.php");
    }
} else {
    include(__DIR__ . "/Views/404NotFound.php");
}