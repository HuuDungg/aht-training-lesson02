<?php
$matrix = [
    [1.2, 2.3, 3.5, 4.6],
    [5.7, 6.8, 7.9, 8.1],
    [9.2, 10.3, 11.4, 12.5]
];

$maxValue = $matrix[0][0];
$maxRow = 0;
$maxCol = 0;

for ($i = 0; $i < count($matrix); $i++) {
    for ($j = 0; $j < count($matrix[$i]); $j++) {
        if ($maxValue < $matrix[$i][$j]) {
            $maxValue = $matrix[$i][$j];
            $maxRow = $i;
            $maxCol = $j;
        }
    }
}

echo "max value is: " . $maxValue;
echo "max matrix is: matrix[$maxRow, $maxCol]";
