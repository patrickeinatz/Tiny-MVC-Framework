<?php
session_start();
require_once __DIR__ . "/init.php";

if(!isset($_SERVER['PATH_INFO']))
{
	header("Location: index.php/home");
}

$pathInfo = $_SERVER['PATH_INFO'];

$routes = [
	//REGULAR PAGES
	'/home' => [
		'controller' => 'PageController',
		'method' => 'pageview'
  	]
	
];

if (isset($routes[$pathInfo])) 
{
  	$route = $routes[$pathInfo];
  	$controller = $container->make($route['controller']);
	$method = $route['method'];
	$controller->$method();
}

?>
