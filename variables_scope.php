<?php

$a = 5;

function myFunc()
{
    global $a;
    $b = 10;

    return $a + $b;
}

$c = myFunc(); // $c = 15

