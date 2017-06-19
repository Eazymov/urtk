<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $param = json_decode(file_get_contents('php://input'));

  $query = 'DELETE FROM news WHERE id = :id';

  $q = $pdo->prepare($query);

  $q->bindParam(':id', $param->id);

  if (!$q->execute())
  {
    echo 'error';
  }

?>
