<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $params = json_decode(file_get_contents('php://input'));

  $categorie = $params->categorie_id;
  $title          = $params->title;
  $content    = $params->content;
  $id            = $params->id;

  $query = "UPDATE articles SET `categorie_id` = :categorie, `title` = :title, `content` = :content WHERE id = :id";

  $q = $pdo->prepare($query);

  $q->bindParam(':categorie', $categorie);
  $q->bindParam(':title', $title);
  $q->bindParam(':content', $content);
  $q->bindParam(':id', $id);

  if (!$q->execute())
  {
    echo 'error';
  }
?>
