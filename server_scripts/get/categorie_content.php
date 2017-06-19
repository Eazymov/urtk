<?php
  include "../../database.php";

  $id = $_GET['id'];

  if (empty($id)) die();

  $query = "SELECT `id`, `title`, `content` FROM categories WHERE id = $id";

  $categorie = $pdo->query($query)->fetch();

  if (!$categorie)
  {
    echo json_encode(false);
    die();
  }

  $query = "SELECT `id`, `title` FROM articles WHERE categorie_id = $id";

  $articles = $pdo->query($query)->fetchAll();

  $categorie['articles'] = $articles;

  echo json_encode($categorie);
?>
