<?php
if(count($config["links"]) > 0) {
?>
<div class="card mb-4">
  <div class="card-header"><h5><i class="fas fa-fw fa-globe-americas"></i> Links</h5></div>
    <div class="card-body">
      <div class="card-text">
        <ul class="list-unstyled text-primary">
          <?php
          require_once __DIR__ . '/../config/config.inc.php';
            foreach ($config["links"] as $key) {
              ?>
              <li><i class="<?php echo($key[0]); ?>"></i> <a href="<?php echo($key[2]); ?>" class="text-primary"><?php echo($key[1]); ?></li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
</div>
<?php
}
?>
