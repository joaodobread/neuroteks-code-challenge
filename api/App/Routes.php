<?php

use App\Core\Router;

$routes = Router::getResources();


$routes->get("/news", "NewsController.index");
$routes->post("/news", "NewsController.store");
