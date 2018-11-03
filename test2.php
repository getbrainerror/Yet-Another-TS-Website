<?php

require_once(__DIR__ . '/includes/tsutils.inc.php');
$tsAdmin = getTeamspeakConnection();
$tsList = json_decode($tsAdmin->getViewer(new TeamSpeak3_Viewer_Json()));

echo("<pre>");
print_r($tsList);
echo("</pre>");
?>
