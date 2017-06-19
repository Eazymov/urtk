<?php
  include '../../database.php';

  $id = $_GET['id'];

  if (empty($id)) die();

  $query = "SELECT
              `title`, `content`, `categorie_id`, DATE_FORMAT(`date`, '%Y-%m-%d') AS date
            FROM articles
            WHERE id = $id";

  $data = $pdo->query($query)->fetch();

  echo json_encode($data);
?>
