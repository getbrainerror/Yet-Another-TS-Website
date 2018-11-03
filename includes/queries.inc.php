<?php
$pdoQueries = array(
  //Add User
  'userlist' => "SELECT * FROM user",
  'useradd' => "INSERT INTO user (nickname, mail, password_hash) VALUES(?, ?, ?);",
  'userdel' => "",
  'userlogin' => "SELECT password_hash, nickname, id FROM user WHERE mail = ? LIMIT 1",
  'userverified' => "SELECT verified FROM user WHERE id = ? LIMIT 1",
  'usermemberof' => "SELECT groups.groupname FROM user_group_assign INNER JOIN groups ON user_group_assign.group_id = groups.id where user_group_assign.user_id = ?",

  'newsget' => "SELECT title, text, create_time, nickname FROM news INNER JOIN user ON news.userid=user.id WHERE public = 1 ORDER BY create_time DESC, news.id DESC LIMIT ? OFFSET ?",
  'newscount' => "SELECT COUNT(id) AS count FROM news WHERE public = 1",
);
?>
