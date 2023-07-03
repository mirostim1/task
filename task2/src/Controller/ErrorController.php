<?php

namespace Task2\Controller;

class ErrorController extends AbstractController {

    public function renderErrorPage(array $error)
    {
        $this->renderView('/error/404.phtml', [
            'message' => $error['message'],
            'code'    => $error['code'],
        ]);
    }
}
