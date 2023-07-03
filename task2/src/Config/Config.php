<?php

namespace Task2\Config;

use Task2\Traits\Singleton;

class Config {

    use Singleton;

    public function getAppConfig()
    {
        require '/var/www/task/task2/config/app.php';
        return (object) $config;
    }
}
