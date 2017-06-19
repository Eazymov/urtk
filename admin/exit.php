<?php
  session_start();
  unset($_SESSION['rights']);
  session_destroy();

  header('Location:../login/index.php');
  exit();
?>
