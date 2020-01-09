<?php

require_once(__DIR__ . '/../autoload.php');

header("Access-Control-Allow-Origin: *");

use Validate\Support\Router;
use Validate\Support\RoutesLoader;
use Validate\Support\Request;

$uri = trim(urldecode(
	parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
), '/');
$method = $_SERVER["REQUEST_METHOD"];
$params = $method === 'POST' ? $_POST : $_GET;

$request = new Request($uri, $method, $params);
$router = new Router($request);
$routesLoader = new RoutesLoader($router);

$router->run();