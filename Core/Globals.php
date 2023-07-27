<?php

use Core\Response;
use Core\Router;
use Core\Session;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($val): void
{
    echo "<pre>";
    print_r($val);
    echo "</pre>";
    die();
}

/**
 * @param $condition
 * @param int $status
 * @return void
 */
function authorize($condition, int $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        Router::abort($status);
    }
}

/**
 * @param $path
 * @return string
 */
function base_path($path): string
{
    return BASE_PATH . $path;
}

/**
 * @param $path
 * @param array $attributes
 * @return void
 */
function view($path, array $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

#[NoReturn] function redirect($path): void
{
    header("Location: {$path}");
    exit();
}

function old($key, $default = '') {
    return Session::get('old')[$key] ?? $default;
}
