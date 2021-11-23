<?php

require 'app.php';

$route = str_replace('/mvc/', '', $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

$controller = (isset($route[0]) && $route[0] != '') ? $route[0] : 'Home';
$method = (isset($route[1]) && $route[1] != '') ? $route[1] : 'index';
$arg = $route[2] ?? '';

require_once "controllers/$controller.php";

$controller_name = ucfirst($controller) . 'Controller';

$controller = new $controller_name();
$controller->{$method}($arg);

//Bovenstaande code moet je lezen zoals:
//$controller = new MovieController();
//$controller->detail();
