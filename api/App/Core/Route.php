<?php

namespace App\Core;


class Route
{
    public $method; // Http method
    public $path; // Router name
    private $function; // Controller method name
    private $class; // Controller class name

    public function __construct($method, $path, $resource)
    {
        $this->method = $method;
        $this->path = $path;
        [$class, $function] = explode(".", $resource);

        $this->function = $function;


        $class = ("App\\Controllers\\$class");

        $this->class = new $class;
    }

    public function call($params)
    {
        return $this->class->{$this->function}($params);
    }
}
