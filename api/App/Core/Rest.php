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
        
        if (!isset($this->router))
            $return = array("message" => "Rotas precisam ser definidas");

        $payload = self::parseUrl($_REQUEST, $_SERVER);

        

        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $formdata = array();
            self::parse_raw_http_request($formdata);

            $payload->body = array_merge($payload->body, $formdata);
        }

        $resource = $this->findResource($payload->path, $payload->http_method);

        try {
            if (isset($resource)) {
                $return = $resource->call($payload);
                if (!isset($return))
                    $return = array("message" => "Operação bem sucedida", "status" => 200);
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


    static function parse_raw_http_request(array &$a_data)
    {
        $input = file_get_contents('php://input');
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];

        $a_blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);

        foreach ($a_blocks as $id => $block) {
            if (empty($block))
                continue;


            if (strpos($block, 'application/octet-stream') !== FALSE) {

                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
            } else {

                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            $a_data[$matches[1]] = $matches[2];
        }
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
