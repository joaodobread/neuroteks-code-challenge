<?php

namespace App\Core;

use App\Core\Route;

class Router
{
    private static $instance;
    public $routes = [];

    static public function getResources()
    {
        if (isset(self::$instance))
            return self::$instance;
        return self::$instance = new self;
    }

    public function get(String $path, String $resource)
    {
        $route = new Route("GET", $path, $resource);
        array_push($this->routes, $route);
    }

    public function post(String $path, String $resource)
    {
        $route = new Route("POST", $path, $resource);
        array_push($this->routes, $route);
    }

    public function put(String $path, String $resource)
    {
        $route = new Route("PUT", $path, $resource);
        array_push($this->routes, $route);
    }

    public function delete(String $path, String $resource)
    {
        $route = new Route("DELETE", $path, $resource);
        array_push($this->routes, $route);
    }

    # force standard methods to singleton work
    public function __construct()
    {
    }
    public function __clone()
    {
    }
    public function __wakeup()
    {
    }
}
