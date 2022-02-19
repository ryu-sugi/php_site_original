<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP SHOP SITE</title>
</head>
<body>

  <?php

    $pro_name = $_POST['code'];
    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];
    $pro_name = $_POST['gazou_name_old'];
    $pro_gazou = $_FILES['gazou'];


    $pro_name = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
    $pro_price = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
    $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');
    $pro_price = htmlspecialchars($pro_gazou_old, ENT_QUOTES, 'UTF-8');
    $pro_price = htmlspecialchars($pro_gazou, ENT_QUOTES, 'UTF-8');

  ?>
</body>
</html>