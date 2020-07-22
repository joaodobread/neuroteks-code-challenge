<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Repository;
use Error;
use Exception;

class NewsController implements Controller
{
    private $news;
    public function __construct()
    {
        $this->news = new Repository("news");
    }

    public function index($params): array
    {
        return $this->news->getAll();
    }

    public function store($params)
    {
        $query = "INSERT INTO news VALUES(null, :title, :image, :text)";
        $stmt = $this->news->prepare($query);

        $stmt->execute(array(
            ":title" => $params->body["title"],
            ":image" => $params->body["image"],
            ":text" => $params->body["text"]
        ));

        $id = $this->news->lastInsertId();


        return $this->news->getById($id);
    }


    public function edit($params): array
    {
        $item = $this->news->getById($params->body["id"]);
        if (!$item)
            return array("message" => "Registro não encontrado");
        $query = "UPDATE news SET title = :title, image = :image, text = :text WHERE id = :id";
        $stmt = $this->news->prepare($query);
        $stmt->execute(array(
            ":title" => $params->body["title"],
            ":image" => $params->body["image"],
            ":text" => $params->body["text"],
            ":id" => $params->body["id"],
        ));
        return $this->news->getById($params->body["id"]);
    }


    public function delete($params)
    {
        $item = $this->news->getById($params->body["id"]);
        if (!$item)
            return array("message" => "Registro não encontrado", "status" => 404);
        $this->news->deleteById($params->body["id"]);
    }


    public function show($params): array
    {
        $item = $this->news->getById($params->body["id"]);
        if (!$item){
          http_response_code(404);
          return array("message" => "Registro não encontrado", "status" => 404);
        }
        return $this->news->getById($params->body["id"]);
    }
}
