<?php

$sql = "CREATE TABLE `items` (
     `id` bigint NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `title` varchar(255) NOT NULL,
     `notes` text,
     `score` int NOT NULL,
     `priority` tinyint NOT NULL,
     `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`),
     UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
