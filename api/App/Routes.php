<?php

use App\Core\Router;

$routes = Router::getResources();


$routes->get("/news", "NewsController.index");
$routes->get("/news/one", "NewsController.show");
$routes->post("/news", "NewsController.store");
$routes->delete("/news", "NewsController.delete");
$routes->put("/news", "NewsController.edit");
