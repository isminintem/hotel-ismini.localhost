<?php

$b = 5;

function myFunc($a)
{
    $b = 10;

    return $a + $b;
}

$c = myFunc(5); // $c = 15

echo $b; // Outputs: 5
