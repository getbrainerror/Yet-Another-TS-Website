<?php
session_start();
if(isset($_POST['mail']) && isset($_POST['password'])) {
  $mail = $_POST['mail'];
  $password = $_POST['password'];

  if(!empty($mail) && !empty($password)){
    require_once(__DIR__ . '/includes/queries.inc.php');
    $pdo = new PDO('mysql:host=localhost;dbname=yatw', 'root', '');

    $statement = $pdo->prepare($pdoQueries['userlogin']);

    if($statement->execute(array("brain@playzpub.local"))){
      $hash = "";
      $nick = "";
      $userid = "";

      while($row = $statement->fetch()) {
        $userid = $row['id'];
        $nick = $row['nickname'];
        $hash = $row['password_hash'];
      }

      if(!empty($hash)){
        if(password_verify($password, $hash)){
          $groups = array();

          $statement = $pdo->prepare($pdoQueries['usermemberof']);
          $statement->bindParam(1, $userid, PDO::PARAM_INT);
          if($statement->execute()){
            while($row = $statement->fetch()) {
              $groups[] = $row['groupname'];
            }
          }
          $verified = 0;
          $statement = $pdo->prepare($pdoQueries['userverified']);
          $statement->bindParam(1, $userid, PDO::PARAM_INT);

          if($statement->execute()){
            while($row = $statement->fetch()) {
              $verified = $row;
            }
          }

          $_SESSION['nickname'] = $nick;
          $_SESSION['userid'] = $userid;
          $_SESSION['groups'] = $groups;
          $_SESSION['verified'] = $verified;
          
          header('Location: /?page=dashboard');
        } else {
          header('Location: /?page=login&error=1');
        }
      } else {
        header('Location: /?page=login&error=1');
      }

    } else {
      header('Location: /?page=login&error=2');
    }
  } else {
    header('Location: /?page=login&error=0');
  }
} else {
  header('Location: /?page=login');
}


?>
