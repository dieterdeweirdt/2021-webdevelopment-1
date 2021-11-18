<?php

require 'app.php';

$route = str_replace('/mvc/', '', $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

print_r($route);

$controller = $route[0];
$method = $route[1];
$arg = $route[2];

require_once "controllers/$controller.php";

$controller_name = ucfirst($controller) . 'Controller';

//$mc = new MovieController();
//$mc->detail();

$controller = new $controller_name();
$controller->{$method}($arg);
