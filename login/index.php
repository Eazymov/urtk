<?php
  session_start();

  include "../database.php";

  if ($_SESSION['rights'] === 'wsadmin')
  {
    header('Location:../../admin/');
    die();
  }

  $data = json_decode(file_get_contents('php://input'));

  $username = $data->login;
  $password = $data->pass;

  if (!empty($username) AND !empty($password)) {

    $query = $pdo->query('SELECT username, password FROM users WHERE id = 1')->fetch();

    if ($username === $query['username'] && $password === $query['password'])
    {
      $_SESSION['rights'] = 'wsadmin';
      die();

    } else {
      echo 'denied';
      die();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="UTF-8" />

  <title>Авторизация</title>

  <link rel="stylesheet" href="../node_modules/roboto-fontface/css/roboto/roboto-fontface.css" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
  <div id="App"></div>

  <script src="dist/build.js"></script>
</body>
</html>
