<?php
//require_once(__DIR__ . '../lib/TeamSpeak3/TeamSpeak3/.php');
//Falls die mehr zeit als in der Konfig angegeben vergangen ist aktuallisiere den Cache

use phpFastCache\Helper\Psr16Adapter;
require_once __DIR__ . '/../vendor/autoload.php';
$defaultDriver = 'Files';
$Psr16Adapter = new Psr16Adapter($defaultDriver);
require_once __DIR__ . '/../vendor/autoload.php';


?>
