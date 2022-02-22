<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP SHOP SITE</title>
</head>

<body>
  <?PHP
  try {

    $pro_code = $_POST['code'];
    $pro_gazou_name = $_POST['gazou_name'];

    $dsn = 'mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $dbh = null;

    if ($pro_gazou_name != '') {

      unlink('./gazou/' .$pro_gazou_name);
    }
  } catch (Exception $e) {
    print $e;
    exit();
  }

  ?>
  削除しました。 <br>
  <br>
  <a href="pro_list.php">戻る</a>

</body>

</html>