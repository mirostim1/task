<?php

namespace Task2\Validation;

use Task2\Repository\ItemRepository;

class ItemValidation {

    public function validateName(string $name, string $type, ?int $id = null)
    {
        $nameFromDB = (new ItemRepository())->getName($name);

        if ($type === 'insert') {
            if ($nameFromDB['name'] === $name) {
                return false;
            }
        } else if ($type === 'edit') {
            if ($nameFromDB['name'] === $name && $nameFromDB['id'] !== $id) {
                return false;
            }
        }

        return true;
    }
}
