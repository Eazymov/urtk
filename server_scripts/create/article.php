<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $params = json_decode(file_get_contents('php://input'));

  $categorie = $params->categorie_id;
  $title          = $params->title;
  $content    = $params->content;

  $save_as_news = $params->saveAsNews;

  $query = "INSERT INTO articles (`categorie_id`, `title`, `content`) VALUES (:categorie, :title, :content)";

  $q = $pdo->prepare($query);

  $q->bindParam(':categorie', $categorie);
  $q->bindParam(':title', $title);
  $q->bindParam(':content', $content);

  if (!$q->execute())
  {
    echo 'error';
    die();
  }

  $id = $pdo->lastInsertId();

  if ($save_as_news) {
    $query = "INSERT INTO news (`title`, `content`) VALUES (:title, :content)";

    $q = $pdo->prepare($query);

    $q->bindParam(':title',   $title);
    $q->bindParam(':content', $content);

    if (!$q->execute())
    {
      echo 'error';
      die();
    }
  }

  $data = array('id' => $id);

  echo json_encode($data);
?>
