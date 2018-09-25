<?php
require_once(__DIR__ . "/includes/tsutils.inc.php");
$tsAdmin = getTeamspeakConnection();
if ($tsAdmin->isOffline()){
      die("Server is offline");
}

print("<pre>".print_r($tsAdmin->clientGetByName("<Ole />"),true)."</pre>");

echo(
?>
