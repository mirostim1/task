<?php

namespace Task2\Database;

use PDO;

class Migration {

    private PDO $dbConnection;

    public function __construct() {
        $this->dbConnection = DbConnection::getInstance()->getDB();
    }

    public function runMigration()
    {
        require __DIR__ . '/../../config/db/migration.php';

        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute();
    }
}
