<?php

namespace App\Core;

use App\Core\Model;
use ReflectionClass;

class Repository extends Model
{
    public function __construct($tablename)
    {
        $model_name = "\\App\\Models\\" . ucfirst($tablename) . "Model";
        parent::__construct($tablename, $model_name);
    }
}
