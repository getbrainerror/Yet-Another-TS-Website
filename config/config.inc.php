<?php
$config = array(
  'debug' => true,
  'expireTime' => 1,
  'siteName' => 'Another TS Website',
  'navbarIcon' => '<i class="fab fa-teamspeak"></i>', // Icon from anywhere (Fontawesome, Bootstrap, an Image or empty for no icon)
  //'customCSS' => '<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-gJWVjz180MvwCrGGkC4xE5FjhWkTxHIR/+GgT8j2B3KKMgh6waEjPgzzh7lL7JZT" crossorigin="anonymous">',
  //'customCSS' => '',
  //Max display of news
  'newsLimit' => 5,
  'teamspeak' => array(
    'nickname' => 'ServerSlave' . rand(0,100),
    'nicknameGuest' => 'ServerSlaveGuest' . rand(0,100),
    'host' => 'localhost',
    'publicTeamspeakAdress' => 'localhost', //get Displayed in the Server Status
    'user' => 'serveradmin',
    'password' => 'WsrW78Zf',
    'server_port' => 9987,
    'query_port' => 10011,
    'args' => "use_offline_as_virtual=1&no_query_clients=1",
  ),
  'links' => array(
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
  'serverViewer' => array(
    'ignoreCenterSpacer' => false,
    'ignoreLeftSpacer' => true,
    'ignoreRightSpacer' => true,
    'ignoreRepeatSpacer' => true,
    'ignoredGroupsList' => array("Normal"),
    'ignoredChannelList' => array(15),
    'icons' => array(
      'server' => '<i class="fas fa-fw fa-server"></i>',
      'client' => '<i class="fas fa-fw fa-circle text-success"></i>',
      'channel' => '<i class="fas fa-fw fa-comment"></i>',
      'channel-full' => '<i class="fas fa-fw fa-comment text-danger"></i>',
      'channel-password' => '<i class="fas fa-fw fa-key text-warning"></i>',
    ),
  ),
  'rulesSafeMode' => true, //Dont parse HTML. Useful if you let others edit this files. But useless if you let them edit the whole web directory
);

 ?>
