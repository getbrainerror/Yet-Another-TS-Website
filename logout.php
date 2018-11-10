<?php
session_start();
if(isset($_SESSION['userid'])){
  session_destroy();
  header('Location: ./?page=home&logged-out=1');

} else {
  header('Location: ./?page=home');
}
?>
