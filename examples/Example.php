<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuxat\Illuxatlib as xat;

$latest = xat::getLatest();

echo "New power ID is {$latest['latest']['ID']} and its name is {$latest['latest']['Name']}.";
