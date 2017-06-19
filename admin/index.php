<?php
session_start();

include "../database.php";

if ($_SESSION['rights'] <> 'wsadmin')
{
  header('Location:../login/');
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">

  <title>Панель администратора</title>

  <link rel="stylesheet" href="fonts/material-icons.css">
  <link rel="stylesheet" href="../node_modules/roboto-fontface/css/roboto/roboto-fontface.css">
  <link rel="stylesheet" href="../node_modules/vue-material/dist/vue-material.css">

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
  <div id="App"></div>

  <script src="../node_modules/tinymce/tinymce.min.js"></script>
  <script src="dist/build.js"></script>
</body>
</html>
