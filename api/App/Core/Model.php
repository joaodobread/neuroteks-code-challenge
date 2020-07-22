<?php

namespace App\Core;

use App\Config\AppConfig;
use Exception;
use stdClass;

class Model extends \PDO
{
    private $__tablename__;
    private $children;
    public function __construct($__tablename__, $children)
    {
        try {
            //code...
            $this->children = $children;
            $this->__tablename__ = $__tablename__;
            $database_config_file = AppConfig::$database;
            $dns = "mysql:host={$database_config_file['db_host']};dbname={$database_config_file['db_name']}";

            parent::__construct($dns, $database_config_file['db_user'], $database_config_file['db_pass']);
        } catch (\Throwable $th) {
        }
    }

    public function getAll()
    {
        $stmt = $this->prepare("SELECT * FROM $this->__tablename__");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->children);
    }

    public function getById($id)
    {
        $stmt = $this->prepare("SELECT * FROM $this->__tablename__ WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    public function deleteById($id)
    {
        $stmt = $this->prepare("DELETE FROM $this->__tablename__ WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return NULL;
    }

    public function updateById($id)
    {
    }

    public function create()
    {
    }
}
