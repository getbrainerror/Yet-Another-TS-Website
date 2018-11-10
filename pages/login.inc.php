<div class="row">
  <div class="col-md-8">
    <div class="card mb-4">
      <div class="card-header">
          <h5>Login</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 offset-md-3 col-lg-10 offset-lg-1">
                <form action="login.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail:</label>
                    <input type="email" class="form-control" name="mail" placeholder="Deine E-Mail Adresse" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Passwort</label>
                    <input type="password" class="form-control" name="password" placeholder="Dein Passwort" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <?php
                  /*
                  ErrorCodes
                  0 = You need to enter your E-Mail and your Password
                  1 = Mail/Password is wrong
                  2 = Internal error
                  Anything else = Unknown error
                  */
                  if(isset($_GET['error'])){
                ?>
                <div class="alert alert-danger mt-5" role="alert">
                  Login fehlgeschlagen:
                  <?php
                    $error = $_GET['error'];
                    switch ($error) {
                      case 0:
                        echo('Du musst deine E-Mail und dein Kennwort angeben!');
                        break;
                      case 1:
                        echo('E-Mail oder Kennwort falsch!');
                        break;
                      case 2:
                        echo('Interner Fehler!');
                        break;

                      default:
                        echo('Unbekannter fehler!');
                        break;
                    }
                  ?>
                </div>
                <?php
                  }
                ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
