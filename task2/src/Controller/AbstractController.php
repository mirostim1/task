<?php

namespace Task2\Controller;

include '../../config/app.php';

var_dump();

abstract class AbstractController {
    private $config;

    public function __construct()
    {
        $this->config = $config;
    }

    public function renderView(string $view, array $vars = [])
    {
        if ($vars) {
            $this->initializeVars($vars);
        }

        require_once self::VIEWS_PATH . $view;
    }

    private function initializeVars(array $vars)
    {

    }
}
