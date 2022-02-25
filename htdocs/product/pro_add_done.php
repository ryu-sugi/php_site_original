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

  try
  {
    $pro_name=$_POST['name'];
    $pro_price=$_POST['price'];
    $pro_gazou_name = $_POST['gazou_name'];


    $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

    $dsn='mysql:dbname=shop;host=172.18.0.3;port=3306;charset=utf8';
    $user='root';
    $password='password';
    $dbh=new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_gazou_name;
    $stmt->execute($data);

    $dbh=null;

    print $pro_name;
    print 'を追加しました。 <br>';
  
  }
    catch (Exception $e)
  {
    print $e;
    exit();
  }

  ?>
    <a href="pro_list.php">戻る</a>

</body>
</html>