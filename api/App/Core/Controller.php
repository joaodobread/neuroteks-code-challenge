<?php

namespace App\Core;

use App\Core\Types\Params;

interface Controller
{
    public function index(Params $params): array;
    public function show(Params $params);
    public function edit(Params $params);
    public function store(Params $params);
    public function delete(Params $params);
}
