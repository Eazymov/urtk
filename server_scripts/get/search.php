<?php
  include "../../database.php";

  if (!isset($_GET['word'])) die();

  $word = "'%".$_GET['word']."%'";

  $newsQuery = "SELECT `id`, `title`, DATE_FORMAT(`date`, '%Y-%m-%d') AS date
                FROM news
                WHERE title LIKE $word OR content LIKE $word";

  $artcQuery = "SELECT `id`, `title`, DATE_FORMAT(`date`, '%Y-%m-%d') AS date
                FROM articles
                WHERE title LIKE $word OR content LIKE $word";

  $catsQuery = "SELECT `id`, `title`, '00-00-00' AS date
                FROM categories
                WHERE title LIKE $word OR content LIKE $word";

  $news = $pdo->query($newsQuery)->fetchAll();
  $artc = $pdo->query($artcQuery)->fetchAll();
  $cats = $pdo->query($catsQuery)->fetchAll();

  $data = array();

  foreach ($news as $val) {
    $val['obj']  = 'news';

    array_push($data, $val);
  }

  foreach ($artc as $val) {
    $val['obj']  = 'article';

    array_push($data, $val);
  }

  foreach ($cats as $val) {
    $val['obj']  = 'categorie';

    array_push($data, $val);
  }

  echo json_encode($data);
?>
