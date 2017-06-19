<?php
  include "../../database.php";

  $query = "SELECT
              articles.id,
              articles.title,
              DATE_FORMAT(articles.date, '%Y-%m-%d') AS date,
              articles.categorie_id,
              categories.title AS categorie
            FROM
              articles LEFT JOIN categories
            ON
              articles.categorie_id = categories.id";

  $data = $pdo->query($query)->fetchAll();

  echo json_encode($data);
?>
