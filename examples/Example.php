<?php

require_once __DIR__ . '/../vendor/autoload.php'; 

use Illuxat\Illuxatlib;

$latest = Illuxatlib::getLatest();

print_r($latest);