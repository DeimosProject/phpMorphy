<?php

mb_internal_encoding('utf-8');

function __autoload($class)
{
    $path = "classes/$class.php";
    $path = str_replace('\\', '/', $path);
    include_once $path;
}

class autoload {}