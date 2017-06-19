<?php
  include '../../database.php';

  $query = 'SELECT `id`, `title`, `visible` FROM categories WHERE 1';

  $data = $pdo->query($query)->fetchAll();

  echo json_encode($data);
?>
