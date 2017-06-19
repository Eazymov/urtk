<?php
  include "../../database.php";

  $query = 'SELECT `stage`, `panelText` FROM homepage WHERE id = 1';

  $data = $pdo->query($query)->fetch();

  echo json_encode($data);
?>
