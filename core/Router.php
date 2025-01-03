<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        $uri = rtrim($uri, '/');
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $uri = rtrim($uri, '/');
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $method)
    {
        $uri = rtrim(parse_url($uri, PHP_URL_PATH), '/');

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            if (is_array($action)) {
                $controller = new $action[0]();
                $method = $action[1];
                return $controller->$method();
            }

            if (is_callable($action)) {
                return $action();
            }
        }

        echo "Route not found!";
    }
}
