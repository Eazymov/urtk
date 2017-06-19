<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $param = json_decode(file_get_contents('php://input'));
  $logo  = $param->logo;

  $query = 'DELETE FROM sponsors WHERE logo = :logo';

  $q = $pdo->prepare($query);

  $q->bindParam(':logo', $logo);

  if (!$q->execute())
  {
    echo 'error';
  }

  @unlink('../../files/'.$logo);
?>
