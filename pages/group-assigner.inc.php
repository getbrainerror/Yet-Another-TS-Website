<div class="row">
  <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
            <h5>Gruppenzuweiser</h5>
        </div>
        <div class="card-body">
          <div class="alert alert-danger" id="group-assigner-error" role="alert" hidden>

          </div>
          <?php

          print_r($_SESSION);
          if(
            !(
               isset($_SESSION['tsident']) &&
               isset($_SESSION['tsident-verified'])
            ) ||
             (
              isset($_SESSION['tsident']) &&
              isset($_SESSION['tsident-verified']) &&
              $_SESSION['tsident-verified'] == false
            )){
          ?>
          <div id="tsident-nickname-wrapper" >
            <form id="tsident-nickname" action="group-assigner.php?action=tsident" method="get">
              <input type="hidden" value="tsident" name="action" /> <!-- Remove when changing to post method -->
              <div class="form-group">
                <label for="nickname">TeamSpeak 3 Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname">
              </div>
              <small class="form-text">Du musst deinen TeamSpeak 3 Nickname eingeben und mit dem TeamSpeak 3 Server verbunden sein!</small>
              <small class="form-text">Außerdem muss dein IP mit deinem TS3 Client und deinem Browser übereinstimmen</small>
              <button type="submit" class="btn btn-primary float-right">Weiter</button>
            </form>
          </div>
          <div id="tsident-code-wrapper" hidden>
            <form id="tsident-code" action="group-assigner.php?action=verify" method="get">
              <input type="hidden" value="verify" name="action" /> <!-- Remove when changing to post method -->
              <div class="form-group">
                <label for="code">Bestätigunscode:</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="000000000">
              </div>
              <button type="submit" class="btn btn-primary float-right">Weiter</button>
            </form>
          </div>
          <?php
          } else {
          ?>
          <form action="group-assigner.php?action=assign" method="get">
            <?php
            require_once(__DIR__ . '/../lib/simplephpcache/cache.class.php');
            $c = new Cache(array(
              'name'      => 'group-assigner',
              'path'      => __DIR__ . '/../cache/',
              'extension' => '.cache'
            ));
            if($c->isCached('groups')){
              $groups = $c->retrieve('groups');
              for ($i=0; $i < count($groups); $i++) {
                ?>
                <div class="btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary active">
                    <input type="checkbox" name="group<?php echo($i) ?>" autocomplete="off"> $groups
                  </label>
                </div>
                <?php
              }
            } else {
              ?>
              <p>Fehler: Cache muss durch einen Admin aufgebaut werden!</p>
              <?php
            }


            ?>
          </form>
          <?php
          }

          ?>
        </div>
      </div>

  </div>
  <?php
    require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
