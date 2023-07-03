<?php

namespace Task2\Config;

class Config {

    public static function getAppConfig()
    {
        include_once '/var/www/task/task2/config/app.php';
        return (object) $config;
    }
}
