<?php
  session_start();

  include "../../database.php";

  if ($_SESSION['rights'] <> 'wsadmin') die();

  $title = $_POST['title'];
  $link  = $_POST['link'];
  $logo  = $_FILES['logo'];

  $filename = rus2eng($logo['name']);
  $filepath = 'files/'.$filename;

  if (!move_uploaded_file($logo['tmp_name'], '../../'.$filepath))
  {
    echo 'error';
    die();
  }

  $query = 'INSERT INTO sponsors (title, logo, link) VALUES (:title, :logo, :link)';

  $q = $pdo->prepare($query);

  $q->bindParam(':title', $title);
  $q->bindParam(':logo',  $filename);
  $q->bindParam(':link',  $link);

  if (!$q->execute())
  {
    echo 'error';
    unlink('../../'.$filepath);

    die();
  }

  $data = array(
    'title' => $title,
    'link'  => $link,
    'logo'  => $filename
  );

  echo json_encode($data);
?>
