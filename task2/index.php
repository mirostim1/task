<?php

require 'vendor/autoload.php';
require 'config/routes.php';

use Task2\Controller\ErrorController;

const CONTROLLER_CLASS = 'Task2\Controller\IndexController';

if (in_array($_SERVER['REQUEST_URI'], array_keys($routes))) {
    $controller = new (CONTROLLER_CLASS);
    $controller->{$routes[$_SERVER['REQUEST_URI']]}();
} else {
    (new ErrorController())->renderErrorPage([
        'message' => 'Page not found',
        'code'    => '404',
    ]);
}
