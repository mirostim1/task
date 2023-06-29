<?php

namespace Task2\Controller;

class IndexController extends AbstractController {

    public function index()
    {
        $this->renderView('/index/index.phtml', []);
    }

    public function addNew()
    {
        $this->renderView('/add-new/index.phtml', []);
    }

    public function listAll()
    {
        $this->renderView('/list-all/index.phtml', []);
    }

    public function editItem()
    {
        $this->renderView('/edit-item/index.phtml', []);
    }
}