<?php
  if(!isset($_SESSION['userid']))
?>

<div class="row">
  <div class="col-md-12">
    <h1 class="display-4 mb-4">Dashboard</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <p>Eingeloggt als <?php echo($_SESSION['nickname']);?></p>
  </div>
  <?php
  require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
