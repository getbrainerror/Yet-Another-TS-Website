<?php
  if(!isset($_SESSION['userid'])){
    header('Location: ?page=login');
  }
?>
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">
              <h5>Dashboard</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          Du musst dein Account bestätigen: <a href="#" class="alert-link">Account jetzt bestätigen!</a>
        </div>
        <div id="success-message" class="alert alert-success" role="alert" hidden>
        </div>
        <div id="error-message" class="alert alert-danger" role="alert" hidden>
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
              <a class="btn btn-secondary" href="#" role="button" data-toggle="modal" data-target="#modalChangePassword" >Passwort ändern</a>
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
              <a class="btn btn-info" href="#" role="button" data-toggle="modal" data-target="#modalArticleManager">Artikel freischalten</a>
              <?php
              }
              ?>
              <a class="btn btn-info" href="#" role="button" data-toggle="modal" data-target="#modalNewArticle">Artikel erstellen</a>
            </p>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalArticleManager" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="#" method="post">
              <div class="modal-header">
                <h5 class="modal-title">Artikel Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="alert alert-info" role="alert">
                  Änderung wurde gespeichert!
                </div>
                <table class="table table-striped table-sm table-responsive-lg">
                  <thead>
                    <tr>
                      <th class="w-auto" scope="col">#</th>
                      <th class="w-50">Titel</th>
                      <th class="w-25">Erstellt am</th>
                      <th class="w-auto">Autor</th>
                      <th class="w-auto">Öffentlich</th>
                      <th class="w-auto">Löschen</th>
                      <th class="w-auto">Anzeigen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      for ($i=0; $i < 100; $i++) {
                    ?>
                    <tr>
                      <th scope="row"><?php echo($i + 1) ?></th>
                      <td>Artikel <?php echo($i + 1) ?></td>
                      <td>22.10.2018</td>
                      <td>getBrainError</td>
                      <td class="text-center"><input type="checkbox"></td>
                      <td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#article<?php echo($i) ?>"><i class="fas fa-eye"></i></button></td>
                    </tr>
                    <tr>
                      <td colspan="7" id="article<?php echo($i) ?>" class="collapse">
                        <textarea class="w-100 form-control mt-3 mb-2" rows="15">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</textarea>
                        <button type="button" class="btn btn-primary float-right mt-2 mb-3" data-toggle="collapse" data-target="#article<?php echo($i) ?>">Speichern</button>
                      </td>

                    </tr>

                    <?php
                      }


                    ?>



                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalNewArticle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="#" method="post">
              <div class="modal-header">
                <h5 class="modal-title">Artikel erstellen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="title">Titel:</label>
                  <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                  <label for="article">Artikel:</label>
                  <textarea class="form-control" id="article" name="article" rows="15"></textarea>
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
      <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-hidden="true">
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
      if(in_array('admin', $_SESSION['groups'])){
      ?>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Gruppenzuweiser</h5>
          </div>
          <div class="card-body">
            <p>Diese Funktion wird nur benötigt falls du die Konfiguration geändert oder die TeamSpeak Gruppen verändert hast</p>
            <button type="button" class="btn btn-info" onclick="buildCache();">Cache erneuern</button>
          </div>
        </div>
      </div>
      <script>
      function buildCache() {
          $.ajax({
              url: "group-assigner.php?action=build-cache",
              success: function (result) {
                if(result == 'OK')
                showSuccessMessage("<p>Vorgang wurde erfolgreich abgeschlossen.</p><p>Antwort vom Server: " + result) + "</p>";
                else {
                showErrorMessage("<p>Vorgang konnte nicht erfolgreich abgeschlossen werden</p><p>Antwort vom Server: " + result + "</p>");
                }
              },
              error: function (result) {
              }
          });
      }
      </script>
      <?php
      }
      //Only for DEBUG
      print_r($_SESSION);
      ?>

    </div>
    <script>
    function showSuccessMessage(message){
      $(document).ready(function() {
          hideErrorMessage();
          $('#success-message').removeAttr('hidden');
          $("#success-message").html(message);
      });
    }
    function showErrorMessage(message){
      $(document).ready(function() {
          hideSuccessMessage();
          $('#error-message').removeAttr('hidden');
          $("#error-message").html(message);
      });
    }
    function hideErrorMessage(){
      $('#error-message').attr('hidden','hidden');
    }
    function hideSuccessMessage(){
      $('#error-message').attr('hidden','hidden');
    }

    </script>
  </div>
  <?php
  require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
