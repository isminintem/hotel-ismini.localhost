<?php

// Commands to generate output

// echo
echo "Hello world! \n";
echo("Hello world again! \n");

// var_dump()
$a = "abcdefg";
var_dump($a);

// print
print "Hello world!\n";
print("Hello world again!\n");

// print_r
$a = ["one" => "red", "two" => "blue"];
print_r($a);
$output = print_r($a, true);