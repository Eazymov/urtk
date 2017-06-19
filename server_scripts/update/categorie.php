<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $data = json_decode(file_get_contents('php://input'));

  $fields = array();

  foreach ($data as $key => $value)
  {
    if ($key === 'id') continue;

    array_push($fields, '`'.$key.'` = :' . $key);
  }

  $query = 'UPDATE categories SET ' . join(', ', $fields) . ' WHERE `id` = :id';

  $q = $pdo->prepare($query);
  $res = '';
  foreach ($data as $key => $value)
  {
    $q->bindValue(':'.$key, $value);
  }

  if (!$q->execute())
  {
    echo 'error';
    die();
  }

  if (!empty($data->content))
  {
    unset($data->content);
  }

  echo json_encode($data);
?>
