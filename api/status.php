<?php
// error_reporting(0);
header('Content-Type: application/json');
set_error_handler("exception_error_handler", E_ALL);
require_once(__DIR__ . '/../config/config.inc.php');
require_once(__DIR__ . '/../includes/tsutils.inc.php');
require_once(__DIR__ . '/../lib/simplephpcache/cache.class.php');

//date_default_timezone_set($config["general"]["timezone"]);
$c = new Cache(array(
  'name'      => 'serverstatus',
  'path'      => __DIR__ . '/../cache/',
  'extension' => '.cache'
));


$c->eraseExpired();
if(!$c->isCached('serverstatus')) {
    $c->store('serverstatus',getResult(), $config['expireTime']);
}
die ($c->retrieve('serverstatus'));

// *********
//  METHODS
// *********
function getResult() {
    try {
        $start = microtime(true);
        $tsstatus = "";
        $tsstatus = getTeamspeakServerStatus();
        $stop = microtime(true);
        return json_encode(array(
            "success" => true,
            "data" => $tsstatus,
            "generated" => date('d-m-Y H:i:s'),
            "timeRequired" => $stop - $start
        ));
    } catch (Exception $e) {
        scriptFail($e);
    }
}
function scriptFail($error) {
    die(json_encode(array(
        "success" => false,
        "id" => "script_error",
        "message" => "There has been an error while retrieving the server status",
        "error" => $error
    )));
}

function serverIsOffline(){
  die(json_encode(array(
      "success" => false,
      "id" => "script_error",
      "message" => "Server is Offline",
  )));
}
function exception_error_handler($errno, $errstr, $errfile, $errline) {
    scriptFail("[$errfile @ $errline] " . $errstr);
}
function getTeamspeakServerStatus() {
    global $config;
    $tsAdmin = getTeamspeakConnection();
    if ($tsAdmin->isOffline()){
      errorMessage("server_offline", "Server ist Offline!");
    }
    $response = $tsAdmin->getInfo();
    if ($response) {
      $onlineUsers = Array();
        foreach ($tsAdmin->clientList() as $client) {
            array_push($onlineUsers, htmlspecialchars($client->__toString()));

        }
        return array(
          "online"           => $response["virtualserver_status"]->toString() == "online",
          "name"              => $response["virtualserver_name"]->toString(),
          "publicAdress"      => $config["publicTeamspeakAdress"],
          "clientsonline"     => $response["virtualserver_clientsonline"] - $response["virtualserver_queryclientsonline"],
          "maxclients"        => $response["virtualserver_maxclients"],
          "version"           => TeamSpeak3_Helper_Convert::versionShort($response["virtualserver_version"]->toString())->toString(),
          "uptime"            => TeamSpeak3_Helper_Convert::seconds($response["virtualserver_uptime"], false, "%dd %02dh %02dm"),
          "averagePacketloss" => $response["virtualserver_total_packetloss_total"]->toString(),
          "averagePing"       => $response["virtualserver_total_ping"]->toString(),
          "onlineUsers"       => $onlineUsers,
        );
    } else {
        return array(
            "success" => false,
            "id" => "not_responding",
            "message" => "Server is not responding"
        );
    }
}
