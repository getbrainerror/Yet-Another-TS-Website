<div class="row">
  <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
            <h5>Regeln</h5>
        </div>
        <div class="card-body">
          <?php
          require_once(__DIR__ . '/../lib/parsedown/Parsedown.php');
          require_once(__DIR__ . '/../config/config.inc.php');
          $parsedown = new Parsedown();
          $parsedown->setSafeMode($config['rulesSafeMode']);
          echo($parsedown->text(file_get_contents(__DIR__ . '/../config/rules.md')));
          ?>
        </div>
      </div>

  </div>
  <?php
    require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
