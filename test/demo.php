<?php 
include "../vendor/autoload.php";

use  U0mo5\Tools as T;


// T\Apis\Qrcode::show("31637200");

// T\Apis\Stock::json("sh601933","min");



$array=[['a'=>1],['a'=>2]];
$field="a";
$out=T\Arrays\Arr::getCol($array, $field);
print_r($out);