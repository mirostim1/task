<?php

namespace Task2\Controller;

class IndexController extends AbstractController {

    public function index()
    {
        $this->renderView('/index/index.phtml', []);
    }

    public function addNew()
    {
        $this->renderView('/index/add-new.phtml', []);
    }

    public function listAll()
    {
        $this->renderView('/index/list-all.phtml', []);
    }

    public function editItem()
    {
        $this->renderView('/index/edit-item.phtml', []);
    }
}