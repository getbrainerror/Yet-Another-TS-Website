<?php
if(isset($_SESSION['userid'])){
  session_start();
  session_destroy();
  header('Location: ./?page=home&logged-out=1');

} else {
  header('Location: ./?page=home');
}
?>
