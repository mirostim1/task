<?php

namespace Task2\Repository;

use Task2\Database\DbConnection;
use Task2\Model\Item;
use PDO;

class ItemRepository {

    private $config;

    public function __construct()
    {
        $this->dbConnection = DbConnection::getInstance();
    }

    public function getAllItems(): array
    {
        $stmt = $this->dbConnection->getDB()->prepare("SELECT id, name, title, notes, score, priority, created_at,
            updated_at FROM `items` ORDER BY created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        return $stmt->fetchAll();
    }

    public function getOneItem(int $id)
    {
        $stmt = $this->dbConnection->getDB()->prepare("SELECT id, name, title, notes, score, priority, created_at,
            updated_at FROM `items` WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        return $stmt->fetchAll()[0];
    }

    public function saveNewItem(Item $item) {
        $stmt = $this->dbConnection->getDB()->prepare("
            INSERT INTO `items`(name, title, notes, score, priority, created_at, updated_at) VALUES 
            (:name, :title, :notes, :score, :priority, :created_at, :updated_at)
        ");

        $stmt->execute([
            'name'       => $item->getName(),
            'title'      => $item->getTitle(),
            'notes'      => $item->getNotes(),
            'score'      => $item->getScore(),
            'priority'   => $item->getPriority(),
            'created_at' => $item->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $item->getUpdatedAt()->format('Y-m-d H:i:s'),
        ]);

        return true;
    }

    public function updateItem(Item $item) {
        $stmt = $this->dbConnection->getDB()->prepare("
            UPDATE `items` SET 
                name = :name,
                title = :title, 
                notes = :notes, 
                score = :score, 
                priority = :priority, 
                updated_at = :updated_at
            WHERE id = :id
        ");

        $result = $stmt->execute([
            'name'       => $item->getName(),
            'title'      => $item->getTitle(),
            'notes'      => $item->getNotes(),
            'score'      => $item->getScore(),
            'priority'   => $item->getPriority(),
            'updated_at' => $item->getUpdatedAt()->format('Y-m-d H:i:s'),
            'id'         => $item->getId(),
        ]);

        return true;
    }

    public function getName(string $name)
    {
        $stmt = $this->dbConnection->getDB()->prepare("SELECT id, name FROM `items` WHERE name = :name LIMIT 1");
        $stmt->execute([
            'name' => $name,
        ]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll()[0];
    }
}
