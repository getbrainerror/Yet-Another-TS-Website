<?php
require_once(__DIR__ . '/../lib/web-ts/serverinfo.php');
$tsServerInfo = getTeamspeakServerStatus();
?>

<div class="col-md-4">
  <?php
    require_once('serverinfo.inc.php');
    require_once('userlist.inc.php');
    require_once('links.inc.php');
   ?>


</div>
