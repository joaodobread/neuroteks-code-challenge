<?php

namespace App\Core;

use App\Config\AppConfig;
use stdClass;

class Model extends \PDO
{
    private $__tablename__;
    private $children;
    public function __construct($__tablename__, $children)
    {
        $this->children = $children;
        $this->__tablename__ = $__tablename__;
        $database_config_file = AppConfig::$database;
        $dns = "mysql:host={$database_config_file['db_host']};dbname={$database_config_file['db_name']}";
        parent::__construct($dns, $database_config_file['db_user'], $database_config_file['db_pass']);
    }

    public function getAll()
    {
        $stmt = $this->prepare("SELECT * FROM $this->__tablename__");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->children);
    }

    public function getById($id)
    {
        $stmt = $this->prepare("SELECT * FROM $this->__tablename__ WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->children);
    }


    public function deleteById($id)
    {
        $stmt = $this->prepare("DELETE FROM $this->__tablename__ WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->children);
    }

    public function updateById($id)
    {
    }

    public function create()
    {
    }
}
