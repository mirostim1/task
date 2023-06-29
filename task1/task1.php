<?php

$array = [3, 2, 1, 0, 1, 2, 3];
// $array = [7, 2, 3, 1, 1, 5, 2, 6];
// $array = [7, 1, 7];

foreach ($array as $key => $item) {
    if (
        $key > 0 &&
        array_sum(array_slice($array, 0, $key)) === array_sum(array_slice($array, $key + 1))
    ) {
        echo 'Array key index that matches the solution: ' . $key;
        die;
    }
}

echo 'No array key that matches the solution.';
