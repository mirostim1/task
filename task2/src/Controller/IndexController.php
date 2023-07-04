<?php

namespace Task2\Controller;

use Task2\Database\Migration;
use Task2\Model\Item;
use Task2\Repository\ItemRepository;
use Task2\Validation\ItemValidation;
use Task2\Pagination\Pagination;

class IndexController extends AbstractController {

    public function index()
    {
        $this->renderView('/index/index.phtml', []);
    }

    public function addNew()
    {
        if ($_POST['submit']) {
            $item = new Item();
            $item->setName($_POST['name']);
            $item->setTitle($_POST['title']);
            $item->setNotes($_POST['notes']);
            $item->setScore($_POST['score']);
            $item->setPriority($_POST['priority']);
            $item->setCreatedAt(new \DateTimeImmutable());
            $item->setUpdatedAt(new \DateTimeImmutable());

            $validation = new ItemValidation();

            if (!$validation->validateName($item->getName(), 'insert')) {
                $this->renderView('/index/add-new.phtml', [
                    'action'  => 'Add New Item',
                    'status'  => 'error',
                    'message' => 'Name with that value already exists. Please enter some other unique name.',
                    'item'    => $item,
                ]);
            }

            try {
                (new ItemRepository())->saveNewItem($item);

                $this->renderView('/index/add-new.phtml', [
                    'action' => 'Add New Item',
                    'status' => 'success',
                ]);
            } catch (\Exception $e) {
                $this->renderView('/index/add-new.phtml', [
                    'action' => 'Add New Item',
                    'status' => 'error',
                ]);
            }
        }

        $this->renderView('/index/add-new.phtml', []);
    }

    public function listAll()
    {
        $page = $_GET['page'];

        $page = $page ? (int) $page : 1;

        $allItems = (new ItemRepository())->getAllItems();

        $listAllItems = [];
        foreach ($allItems as $item) {
            $newItemObj = new Item();
            $newItemObj->setId($item->id);
            $newItemObj->setName($item->name);
            $newItemObj->setTitle($item->title);
            $newItemObj->setNotes($item->notes);
            $newItemObj->setScore($item->score);
            $newItemObj->setPriority($item->priority);
            $newItemObj->setCreatedAt(new \DateTimeImmutable($item->created_at));
            $newItemObj->setUpdatedAt(new \DateTimeImmutable($item->updated_at));

            $listAllItems[] = $newItemObj;
        }

        $pagination = new Pagination($listAllItems, $page);
        $paginationItems = $pagination->paginate();

        $this->renderView('/index/list-all.phtml', [
            'pagination' => $paginationItems,
        ]);
    }

    public function editItem()
    {
        if (isset($_POST['submit']) && $_POST['submit']) {
            $item = new Item();
            $item->setName($_POST['name']);
            $item->setTitle($_POST['title']);
            $item->setNotes($_POST['notes']);
            $editScore = $_POST['score'] + 1;
            $item->setScore($editScore);
            $item->setPriority($_POST['priority']);
            $item->setUpdatedAt(new \DateTimeImmutable());
            $item->setId($_POST['id']);

            $validation = new ItemValidation();

            if (!$validation->validateName($item->getName(), 'edit', $_POST['id'])) {
                $this->renderView('/index/edit-item.phtml', [
                    'action'  => 'Add New Item',
                    'status'  => 'error',
                    'message' => 'Name with that value already exists. Please enter some other unique name.',
                    'item'    => $item,
                ]);
            }

            try {
                (new ItemRepository())->updateItem($item);

                $this->renderView('/index/edit-item.phtml', [
                    'action' => 'Edit Item',
                    'status' => 'success',
                    'item'   => $item,
                ]);
            } catch (\Exception $e) {die('3');
                $this->renderView('/index/edit-item.phtml', [
                    'action' => 'Edit Item',
                    'status' => 'error',
                    'item'   => $item,
                ]);
            }
        }

        $id = $_GET['id'];

        if (!$id) {
            (new ErrorController())->renderErrorPage([
                'message' => 'Page not found. Param ID must be provided.',
                'code'    => '404',
            ]);
        }

        $item = (new ItemRepository())->getOneItem($id);

        if (!$item) {
            (new ErrorController())->renderErrorPage([
                'message' => 'Page not found. Item with ID (' . $id . ') not exist.',
                'code'    => '404',
            ]);
        }

        $itemObj = new Item();
        $itemObj->setId($item->id);
        $itemObj->setName($item->name);
        $itemObj->setTitle($item->title);
        $itemObj->setNotes($item->notes);
        $itemObj->setScore($item->score);
        $itemObj->setPriority($item->priority);
        $itemObj->setCreatedAt(new \DateTimeImmutable($item->created_at));
        $itemObj->setUpdatedAt(new \DateTimeImmutable($item->updated_at));

        $this->renderView('/index/edit-item.phtml', [
            'item' => $itemObj,
        ]);
    }

    public function runMigration()
    {
        try {
            $migration = new Migration();
            $migration->runMigration();
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage(), 500);
        }

        echo 'Migration executed successfully.';
    }
}