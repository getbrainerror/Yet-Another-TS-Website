<?php
$config = array(
  'debug' => true,
  'expireTime' => 30,
  'siteName' => 'Another TS Website',
  'teamspeak' => Array(
    'nickname' => 'ServerSlave' . rand(0,100),
    'host' => 'addresse',
    'user' => 'user',
    'password' => 'pass',
    'server_port' => 9987,
    'query_port' => 10011,
  ),
  'links' => Array(
    //Always use fa-fw for correct formatting
    //["FONTAWESOME ICON Classes","LINKNAME","URL"]
    ["fab fa-fw fa-teamspeak","TeamSpeak: Join Me", "#"],
    ["fab fa-fw fa-facebook-f","Facebook Page", "#"],
    ["fab fa-fw fa-whatsapp","Whatsapp Gruppe", "#"],
    ["fab fa-fw fa-telegram-plane","Telegram Gruppe", "#"],
    ["fas fa-fw fa-envelope","E-Mail", "#"],
  )
);

 ?>
