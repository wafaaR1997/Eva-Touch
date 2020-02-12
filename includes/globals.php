<?php

define('PSIZE',3);

global $perms;
global $productStatus;
global $uploadErrors;




$perms = [
    1 => ["Supervisor", "#f00"],
    2 => ["Service Provider", "#800000"],
    3 => ["Customer", "#18a689"],

];

$productStatus = [

    3 => ["Disabled", "#f00"],
    2 => ["Not Available", "#f00"],
    1 => ["Available", "#18a689"],

];

$uploadErrors = [
    "File Type is not allowed",
    "Maximum File size exceeded.",
];




