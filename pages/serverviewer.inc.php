<div class="row">
  <div class="col-md-12">
    <h1 class="display-4 mb-4">Serverbrowser</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="col-md-10 offset-md-1">
      <div class="server-viewer">
      <?php

      require_once(__DIR__ . '/../includes/serverviewer.inc.php');
      echo(generateServerViewer());
      ?>
      </div>
    </div>
  </div>
  <?php
    require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
