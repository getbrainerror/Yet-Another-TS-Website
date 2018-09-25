<?php
$config = array(
  'debug' => true,
  'expireTime' => 1,
  'siteName' => 'Another TS Website',
  'publicTeamspeakAdress' => 'localhost', //get Displayed in the Server Status
  'teamspeak' => Array(
    'nickname' => 'ServerSlave' . rand(0,100),
    'host' => 'localhost',
    'user' => 'serveradmin',
    'password' => 'WsrW78Zf',
    'server_port' => 9987,
    'query_port' => 10011,
    'args' => "use_offline_as_virtual=1&no_query_clients=1",
  ),
  'links' => Array(
    //Always use fa-fw for correct formatting
    //["FONTAWESOME ICON Classes","LINKNAME","URL"]
    ["fab fa-fw fa-teamspeak","TeamSpeak: Join Me", "#"],
    ["fab fa-fw fa-facebook-f","Facebook Page", "#"],
    ["fab fa-fw fa-whatsapp","Whatsapp Gruppe", "#"],
    ["fab fa-fw fa-telegram-plane","Telegram Gruppe", "#"],
    ["fas fa-fw fa-envelope","E-Mail", "#"],
  ),
  'listedUserGroupsTitle' => "Das Team",
  'listedUserGroups' => [6,7],
);

 ?>
