<?php

require_once(__DIR__ . '/includes/tsutils.inc.php');
$tsAdmin = getTeamspeakConnection();
$tsList = $tsAdmin->clientList();

echo("<pre>");
//print_r($tsList);

foreach ($tsAdmin->clientList(array('connection_client_ip', getRealIpAddr())) as $client) {

    print_r($client);
}

echo("</pre>");

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>
