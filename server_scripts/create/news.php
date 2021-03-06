<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $params = json_decode(file_get_contents('php://input'));

  $title       = $params->title;
  $content = $params->content;

  $query = 'INSERT INTO news (`title`, `content`) VALUES (:title, :content)';

  $q = $pdo->prepare($query);

  $q->bindParam(':title',   $title);
  $q->bindParam(':content', $content);

  if (!$q->execute())
  {
    echo 'error';
    die();
  }

  $id = $pdo->lastInsertId();

  $data = array('id' => $id);

  echo json_encode($data);

?>
