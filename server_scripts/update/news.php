<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $params = json_decode(file_get_contents('php://input'));

  $id      = $params->id;
  $title   = $params->title;
  $content = $params->content;

  $query = 'UPDATE news SET `title` = :title, `content` = :content WHERE id = :id';

  $q = $pdo->prepare($query);

  $q->bindParam(':id',      $id);
  $q->bindParam(':title',   $title);
  $q->bindParam(':content', $content);

  if (!$q->execute())
  {
    echo 'error';
  }
?>
