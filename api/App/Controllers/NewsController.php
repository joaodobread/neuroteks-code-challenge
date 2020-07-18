<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Repository;

class NewsController implements Controller
{
    public function __construct()
    {
    }

    public function index($params): array
    {
        $news = new Repository("news");

        return $news->getAll();
    }

    public function store($params): array
    {
        return array();
    }


    public function edit($params): array
    {
        return array();
    }


    public function delete($params): array
    {
        return array();
    }


    public function show($params): array
    {
        return array();
    }
}
