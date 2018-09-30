<?php
session_start();
session_destroy();
header('Location: ./?page=home&logged-out=1');
?>
