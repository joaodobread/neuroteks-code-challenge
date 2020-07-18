<?php

define("BASE_DIRECTORY", __DIR__);

require_once "vendor/autoload.php";
require_once "./App/Core/ErrorHandler.php";
require_once "./App/Routes.php";

use App\Core\Rest;
use App\Core\Router;


$rest = Rest::Rest();
$rest->setRoutes(Router::getResources());
$rest->requestHandler();
