<?php
function findCommonObjects($array1, $array2, $key) {
    $commonObjects = array();

    // Create a lookup table for objects in $array2 based on the specified key
    $lookup = array();
    foreach ($array2 as $obj) {
        $lookup[$obj[$key]] = $obj;
    }

    // Iterate through $array1 and check if the key exists in the lookup table
    foreach ($array1 as $obj) {
        if (isset($lookup[$obj[$key]])) {
            $commonObjects[] = $obj;
        }
    }

    return $commonObjects;
}

// Example arrays of objects
$array1 = array(
    array('id' => 1, 'name' => 'Object 1'),
    array('id' => 2, 'name' => 'Object 2'),
    array('id' => 3, 'name' => 'Object 3')
);

$array2 = array(
    array('id' => 2, 'name' => 'Object 2'),
    array('id' => 4, 'name' => 'Object 4'),
    array('id' => 5, 'name' => 'Object 5')
);

// Key to be used for comparison
$key = 'id';

// Find common objects based on the specified key
$commonObjects = findCommonObjects($array1, $array2, $key);

// Output the common objects
print_r($commonObjects);

