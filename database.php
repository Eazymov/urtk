<?php
  $base = 'mysql:dbname=wsadmin;host=localhost;charset=utf8';
  $user = 'root';
  $pass = '';
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );

  try {
    $pdo = new PDO($base, $user, $pass, $options);
  } catch (Exception $e) {
    echo "<h1 style=\"width: 100%;
                     text-align: center;
                     margin: 210px 0;
                     font-family: sans-serif;
                     font-weight: 400;\">
            Отсутствует соединение с базой данных
          </h1>";
    die();
  }

  function rus2eng($str)
  {
    $cyrillic = array(' ', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
                      'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х',
                      'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б',
                      'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М',
                      'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш',
                      'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я');

    $latin = array('_', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y',
                   'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h',
                   'c', 'ch', 'sh', 'sh', '', 'i', '', 'e', 'yu', 'ya', 'A', 'B',
                   'V', 'G', 'D', 'E', 'E', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M',
                   'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh',
                   'Sh', '', 'I', '', 'E', 'Yu', 'Ya');

    return str_replace($cyrillic, $latin, $str);
  }
?>
