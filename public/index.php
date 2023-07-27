<?php

use Core\Exceptions\ValidationException;
use Core\Session;
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH.'vendor/autoload.php'; //

// If you did not have composer installed on your machine
//spl_autoload_register(function ($class) {
//    $result = str_replace("\\", DIRECTORY_SEPARATOR, $class);
//    require base_path("{$result}.php");
//});

session_start();

require BASE_PATH . "/Core/Globals.php";
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

require base_path('bootstrap.php');

$router = new \Core\Router();
require base_path('routes.php');

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    redirect($router->previousUrl());
}


Session::unfalsh();
