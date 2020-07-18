<?php

namespace App\Config;


class AppConfig
{
    static public $database = array(
        "db_user" => "root",
        "db_pass" => "admin",
        "db_name" => "newsDatabase",
        "db_host" => "api"
    );
    static public $appInfo = array(
        "app-name" => "BreadApi"
    );
};
