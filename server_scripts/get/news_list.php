<?php
  include "../../database.php";

  $query = "SELECT
             `id`, `title`, DATE_FORMAT(`date`, '%Y-%m-%d') AS date
            FROM news
            WHERE 1
            ORDER BY date DESC, id";

  $data = $pdo->query($query)->fetchAll();

  echo json_encode($data);
?>
