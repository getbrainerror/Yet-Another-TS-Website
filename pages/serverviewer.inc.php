<div class="row">
  <div class="col-md-8">
    <div class="card mb-4">
      <div class="card-header">
          <h5>
            Server Viewer
            <span class="float-right"><a href="#" id="server-viewer-emptytoggle" onclick="hideEmptyChannel()" class="text-body" title="Leere Channel ausblenden" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a></span>
          </h5>
      </div>


      <div class="card-body">
            <div class="server-viewer">
                <?php
                require_once(__DIR__ . '/../includes/serverviewer.inc.php');
                echo(generateServerViewer());
                ?>
            </div>
      </div>
    </div>
  </div>
  <?php
    require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
<script src="js/ts-viewer.js"></script>
