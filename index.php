<?php
class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function check()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            if (is_callable($callback)) {
                call_user_func($callback);
            } else {
                // handle invalid callback
                echo 'Invalid callback';
            }
        } else {
            // handle invalid route
            echo 'Invalid route';
        }
    }
}