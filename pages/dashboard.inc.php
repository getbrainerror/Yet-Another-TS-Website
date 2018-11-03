<?php
  if(!isset($_SESSION['userid'])){
    header('Location: ?page=login');
  }
?>

<div class="row">
  <div class="col-md-12">
    <h1 class="display-4 mb-4">Dashboard</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          Du musst dein Account bestätigen: <a href="#" class="alert-link">Account bestätigen!</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Account Details</h5>
          </div>
          <div class="card-body">
            <p class="mb-4">Eingeloggt als <?php echo($_SESSION['nickname']);?></p>
            <p class="card-text">
              <a class="btn btn-secondary" href="#" role="button"  data-toggle="modal" data-target="#modalChangePassword" >Passwort ändern</a>
              <?php
              if(!in_array('admin', $_SESSION['groups'])){
                ?>
              <a class="btn btn-danger" href="#" role="button">Account löschen</a>
                <?php
              }
              ?>

            </p>
          </div>
        </div>
      </div>
      <?php
      if(
        in_array('news-manager', $_SESSION['groups']) ||
        in_array('news-editor', $_SESSION['groups']) ||
        in_array('news-editor-safemode', $_SESSION['groups'])
      ){
      ?>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>News</h5>
          </div>
          <div class="card-body">
            <p class="mb-4">Hier kannst du einen neuen Artikel erstellen oder freischalten!</p>
            <p class="card-text">
              <?php
              if(in_array('news-manager', $_SESSION['groups'])) {
              ?>
              <a class="btn btn-info" href="#" role="button">News Manager</a>
              <?php
              }
              ?>
              <a class="btn btn-info" href="#" role="button">News Editor</a>
            </p>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="#" method="post">
              <div class="modal-header">
                <h5 class="modal-title">Passwort ändern:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="old-password">Altes Passwort:</label>
                  <input type="password" class="form-control" name="old-password" required>
                </div>
                <div class="form-group">
                  <label for="old-password">Neues Passwort:</label>
                  <input type="password" class="form-control" name="new-password" required>
                </div>
                <div class="form-group">
                  <label for="old-password">Neues Passwort wiederholen:</label>
                  <input type="password" class="form-control" name="new-password-repeat" required>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-primary">Speichern</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <?php
      }
      //Only for DEBUG
      print_r($_SESSION);
      ?>

    </div>

  </div>
  <?php
  require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
