<?php

namespace Task2\Controller;

use Task2\Config\Config;

class AbstractController {

    private $config;

    public function __construct()
    {
        $this->config = Config::getAppConfig();
    }

    public function renderView(string $view, array $vars = [])
    {
        if ($vars) {
            $this->initializeVars($vars);
        }

        require_once $this->config->views_path . $view;
    }

    private function initializeVars(array $vars)
    {
        foreach ($vars as $key => $var) {
            $this->{$key} = $var;
        }
    }
}
