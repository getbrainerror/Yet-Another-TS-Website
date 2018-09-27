<?php
$pdoQueries = array(
  //Add User
  'userlist' => "SELECT * FROM user",
  'useradd' => "INSERT INTO user (nickname, mail, password_hash) VALUES(?, ?, ?);",
  'userdel' => "",
  'userlogin' => "SELECT password_hash, nickname FROM user WHERE mail = ? LIMIT 1",
);
?>
