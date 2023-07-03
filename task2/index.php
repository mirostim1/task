<?php

require 'vendor/autoload.php';
require 'config/routes.php';

use Task2\Controller\ErrorController;

const CONTROLLER_CLASS = 'Task2\Controller\IndexController';

if ($_SERVER['PATH_INFO'] === null) {
    $_SERVER['PATH_INFO'] = '/';
}

if (in_array($_SERVER['PATH_INFO'], array_keys($routes))) {
    $controller = new (CONTROLLER_CLASS);
    $controller->{$routes[$_SERVER['PATH_INFO']]}();
} else {
    (new ErrorController())->renderErrorPage([
        'message' => 'Page not found',
        'code'    => '404',
    ]);
}
