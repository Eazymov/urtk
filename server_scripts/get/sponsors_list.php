<?php
  include "../../database.php";

  $query = 'SELECT `title`, `logo`, `link` FROM sponsors WHERE 1';

  $data = $pdo->query($query)->fetchAll();

  echo json_encode($data);
?>
