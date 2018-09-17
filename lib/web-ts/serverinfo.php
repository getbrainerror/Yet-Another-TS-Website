<?php

function getResult() {
    try {
      $tsstatus = getTeamspeakServerStatus();

    } catch (Exception $e) {
        scriptFail($e);
    }
}


function getTeamspeakServerStatus() {
    //$response = pingTeamspeakServerFromConfig();
    if (true) {
      /*
        return array(
            "success"           => $response["virtualserver_status"]->toString() == "online",
            "name"              => $response["virtualserver_name"]->toString(),
            "clientsonline"     => $response["virtualserver_clientsonline"] - $response["virtualserver_queryclientsonline"],
            "maxclients"        => $response["virtualserver_maxclients"],
            "version"           => TeamSpeak3_Helper_Convert::versionShort($response["virtualserver_version"]->toString())->toString(),
            "platform"          => $response["virtualserver_platform"]->toString(),
            "uptime"            => TeamSpeak3_Helper_Convert::seconds($response["virtualserver_uptime"], false, "%dd %02dh %02dm"),
            "averagePacketloss" => $response["virtualserver_total_packetloss_total"]->toString(),
            "averagePing"       => $response["virtualserver_total_ping"]->toString()
        );
        */
        return array(
            "success" => true,
            "generated" => date('d-m-Y H:i:s'),
            "tsstatus" =>  array(
                "clientsonline"     => 10,
                "maxclients"        => 32,
                "version"           => "3.2.0",
                "platform"          => "Windows",
                "uptime"            => "16d 19h 58m",
                "averagePacketloss" => "0.0006",
                "averagePing"       => "60.3125",
              )
            );

    } else {
        return array(
            "success" => false,
            "generated" => date('d-m-Y H:i:s'),
            "id" => "not_responding",
            "message" => "Server is not responding"
        );
    }
}

function exception_error_handler($errno, $errstr, $errfile, $errline) {
  die(json_encode(array(
    "success" => false,
    "id" => "script_error",
    "message" => "There has been an error while retrieving the server status",
    "error" => "[$errfile @ $errline] " . $errstr,
  )));
}

?>
