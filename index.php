<?php

$numbers = array(6, 3, 23, 4, 43, 12, 3, 5, 4, 547, 321, 2);

function findSmallestNumber($numberArray)
{
    $min = $numberArray[0];
    for ($i = 1; $i < count($numberArray); $i++) {
        if ($min > $numberArray[$i]) {
            $min = $numberArray[$i];
        }
    }
    return $min;
}

echo findSmallestNumber($numbers);
