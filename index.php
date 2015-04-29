<?php

include_once "autoload.php";

use Deimos\phpMorphy;

$morphy = new phpMorphy();

var_dump($morphy->get('ru')->getBaseForm('НОМАЛЬНОЕ'));
var_dump($morphy->get('en')->getAllForms('THINKS'));