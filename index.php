<?php

require '_app/Config.inc.php';

$url = $_SERVER['REQUEST_URI'];//retorna url

$baseUrl = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], '/index.php'));//retorna a raiz

//$baseUrl = começa em PHS e vai até
$queryString = substr($url, strpos($url, '/index.php') + strlen('/index.php'));

$params = array_filter(explode('/', $queryString));

$controllerName = (true === empty($queryString) || 0 === count($params)) ? 
	'DefaultController' : ucfirst(array_shift($params)) . 'Controller';
$actionName = (true === empty($queryString) || 0 === count($params)) ? 
	'indexAction' : (count($params) ? strtolower(array_shift($params)) : 'index') . 'Action';

$controller = new $controllerName();
$controller->$actionName();
