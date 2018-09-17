<?php
require_once __DIR__ . '/../config/config.inc.php';
require_once __DIR__ . "/../lib/TeamSpeak3/TeamSpeak3.php";



function pingTeamspeakServerFromConfig() {
    return pingTeamspeakServer(getTeamspeakConnection("?use_offline_as_virtual=1&no_query_clients=1"));
}
function pingTeamspeakServer() {
    try {
        $tsAdmin = getTeamspeakConnection();
        if ($tsAdmin->isOffline())
            throw new Exception("Server is offline");
        return $tsAdmin->getInfo();
    } catch (TeamSpeak3_Exception $e) {
        return false;
    }
}


function getTeamspeakConnection($arguments = '') {
    try {
        global $config;
        $host   = $config['teamspeak']['host'];
        $user  = $config['teamspeak']['user'];
        $passwd = $config['teamspeak']['password'];
        $sport  = $config['teamspeak']['server_port'];
        $qport  = $config['teamspeak']['query_port'];
        $nickname  = $config['teamspeak']['nickname'];
        $tsNodeHost = TeamSpeak3::factory("serverquery://$host:$qport/?nickname=$nickname");
        $tsNodeHost->login($user, $passwd);
        return $tsNodeHost->serverGetByPort($sport);
    } catch (Exception $e) {
        throw $e;
    }
}
