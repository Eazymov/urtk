<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $params = json_decode(file_get_contents('php://input'));

  $q = $pdo->prepare('UPDATE homepage SET stage = :stage, panelText = :panelText WHERE id = 1');

  $q->bindParam(':stage',     $params->stage);
  $q->bindParam(':panelText', $params->panelText);

  if (!$q->execute())
  {
    echo 'error';
  }

?>
