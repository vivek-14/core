<?php

namespace Core;

use Core\Middleware\Map;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    /**
     * @param $method
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function add($method, $uri, $controller): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    /**
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function get($uri, $controller): Router
    {
        return $this->add('GET', $uri, $controller);
    }

    /**
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function post($uri, $controller): Router
    {
        return $this->add('POST', $uri, $controller);
    }

    /**
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function delete($uri, $controller): Router
    {
        return $this->add('DELETE', $uri, $controller);
    }

    /**
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function put($uri, $controller): Router
    {
        return $this->add('PUT', $uri, $controller);
    }

    /**
     * @param $uri
     * @param $controller
     * @return $this
     */
    public function patch($uri, $controller): Router
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function only($key): Router
    {
        $this->routes[array_key_last ($this->routes)]['middleware'] = $key;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                // Identify Middleware make sure your middleware is listed in Middleware class map
                Map::resolve($route['middleware']);
                return require base_path('HTTP/controllers/' . $route['controller']);
            }
        }
        $this->abort();
    }

    #[NoReturn] public static function abort($status = 404): void
    {
        http_response_code($status);

        require base_path("views/{$status}.view.php");

        die();
    }

    public function previousUrl() {
        return $_SERVER['HTTP_REFERER'];
    }
}
