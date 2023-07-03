<?php

namespace Task2\Database;

use Task2\Config\Config;
use Task2\Traits\Singleton;
use PDO;

class DbConnection {

    use Singleton;

    private $config;

    public function __construct()
    {
        $this->config = Config::getInstance()->getAppConfig();
    }

    public function getDB(): PDO
    {
        try {
            $conn = new PDO($this->config->dsn, $this->config->username, $this->config->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}
