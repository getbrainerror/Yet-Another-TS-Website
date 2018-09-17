<?php
// error_reporting(0);
header('Content-Type: application/json');
set_error_handler("exception_error_handler", E_ALL);
require_once(__DIR__ . "/../includes/tsutils.inc.php");
require_once(__DIR__ . '/../lib/simplephpcache/cache.class.php');

//date_default_timezone_set($config["general"]["timezone"]);
$c = new Cache(array(
  'name'      => 'userOnline',
  'path'      => __DIR__ . '/../cache/',
  'extension' => '.cache'
));


$c->eraseExpired();
if(!$c->isCached('userOnline')) {
    $c->store('userOnline',getResult(), $config['expireTime']);
}
die ($c->retrieve('userOnline'));

// *********
//  METHODS
// *********
function getResult() {
    try {
        $start = microtime(true);
        $userOnline = getAllOnlineUser();
        $stop = microtime(true);
        return json_encode(array(
            "data" => $userOnline,
            "generated" => date('d-m-Y H:i:s'),
            "timeRequired" => $start - $stop
        ));
    } catch (Exception $e) {
        scriptFail($e);
    }
}
function scriptFail($error) {
    die(json_encode(array(
        "success" => false,
        "id" => "script_error",
        "message" => "There has been an error while retrieving data",
        "error" => $error
    )));
}
function exception_error_handler($errno, $errstr, $errfile, $errline) {
    scriptFail("[$errfile @ $errline] " . $errstr);
}
function getAllOnlineUser() {
    $response = pingTeamspeakServerFromConfig();
    if ($response) {
      $result;
      $clients = $ts3_VirtualServer->clientList();
      foreach ($clients as $client => $value) {
        $result = $result + ", " + $client;
      }
        return array(
          "success" => true,
          "users" => $result,
        );
    } else {
        return array(
            "success" => false,
            "id" => "not_responding",
            "message" => "Server is not responding"
        );
    }
}


?>
