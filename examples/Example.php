<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuxat\Illuxatlib as xat;

/**
 * Fetch latest power information
 */

$latest = xat::getLatest();

echo "New power ID is {$latest['latest']['ID']} and its name is {$latest['latest']['Name']}.\n";

/**
 * Fetch shortname price
 */

$shortname = xat::getShortname('sloom2');

$price = $shortname['error'] ? 'error:' : 'price:';

echo "Shortname {$price} {$shortname['message']}.";

/**
 * Fetch promoted chats by a language code
 */

$lang = 'pt';
$promoted = xat::getPromotedChats($lang);

if ($promoted['error'] == true) {
    return print $promoted['message'];
}

foreach ($promoted['message'] as $chatID => $data) {
    echo "Chat ID: {$chatID} - Promoted for: {$data['time']}.\n";
}
