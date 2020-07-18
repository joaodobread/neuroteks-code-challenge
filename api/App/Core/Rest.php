<?php

namespace App\Core;

use App\Core\Types\Params;
use Exception;

class Rest
{
    private static $instance;
    public $router;
    # singleton constructor
    static public function Rest()
    {
        if (isset(self::$instance))
            return self::$instance;
        return self::$instance = new self;
    }

    public function setRoutes(Router $routes)
    {
        $this->router = $routes;
    }

    public function findResource($path, $method)
    {

        foreach ($this->router->routes as $route) {
            if ($route->path == $path && $route->method == $method)
                return $route;
        }
        return NULL;
    }

    public function requestHandler()
    {
        header('Content-Type: application/json');

        if (!isset($this->router))
            $return = array("message" => "Rotas precisam ser definidas");

        $payload = self::parseUrl($_REQUEST, $_SERVER);

        $resource = $this->findResource($payload->path, $payload->http_method);

        try {
            if (isset($resource)) {
                $return = $resource->call($payload);
                http_response_code(200);
            } else {
                $return = array("error" => "Rota não encontrada");
                http_response_code(404);
            }
        } catch (\Throwable $th) {
            $return = array("error" => $th);
            http_response_code(500);
        }


        echo json_encode($return, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }


    private static function parseUrl($request, $server): Params
    {
        $params = new Params();


        $params->http_method = $server["REQUEST_METHOD"];

        $params->path = "/" . $request["url"];
        array_shift($request);
        $params->body = $request;

        return $params;
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
