<?php
require_once(__DIR__ . '/includes/queries.inc.php');
$pdo = new PDO('mysql:host=localhost;dbname=yatw', 'root', '');

$statement = $pdo->prepare($pdoQueries['useradd']);
if($statement->execute(array('get🧠Error', 'brain@playzpub.local', password_hash("123456", PASSWORD_BCRYPT)))) {
  echo('Es wurde ein User mit der ID ' . $pdo->lastInsertId() . ' angelegt!<br />');
} else {
  echo('SQK Error <br />');
  echo($statement->queryString . '<br />');
  echo($statement->errorInfo()[2] . '<br />');
}

foreach ($pdo->query($pdoQueries['userlist']) as $key) {
  echo($key['nickname'] . ' -> ' . $key['mail'] .'<br />');
}

$statement = $pdo->prepare($pdoQueries['userlogin']);
$hash = "";
$nick = "";
if($statement->execute(array("brain@playzpub.local"))){
  while($row = $statement->fetch()) {
    $hash = $row['password_hash'];
    $nick = $row['nickname'];
  }
}


if(password_verify('12323523456', $hash)){
  echo('Logged in ' . $nick . '<br />');
} else {
  echo('Couldnt login! Wrong password?<br />');
}

if(password_verify('123456', $hash)){
  echo('Hello ' . $nick . '<br />');
} else {
  echo('Couldnt login! Wrong password?<br />');
}

if(password_verify('1253423456', $hash)){
  echo('Logged in ' . $nick . '<br />');
} else {
  echo('Couldnt login! Wrong password?<br />');
}


 ?>
