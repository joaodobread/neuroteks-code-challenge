<?php

namespace App\Core;

use App\Core\Types\Params;

interface Controller
{
    public function index(Params $params): array;
    public function show(Params $params): array;
    public function edit(Params $params): array;
    public function store(Params $params): array;
    public function delete(Params $params): array;
}
