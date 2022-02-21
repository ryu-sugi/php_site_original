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

    $pro_code=$_GET['procode'];

    $dsn='mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user='root';
    $password='password';
    $dbh=new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name=$rec['name'];
    $pro_price=$rec['price'];
    $pro_gazou_name=$rec['gazou'];


    $dbh=null;
    
    if($pro_gazou_name=='')
    {
      $disp_gazou='';
    }
    else
    {
      $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
    }

  }
  catch (Exception $e)
  {
    print $e;
    exit();
  }

  ?>

  商品情報参照 <br>
  <br>
  商品コード <br>
  <?php print $pro_code; ?>
  <br>
  商品名 <br>
  <?php print $pro_name; ?>
  <br>
  価格 <br>
  <?php print $pro_price; ?>円
  <br>
  <?php print $disp_gazou; ?>
  <br>
  <br>
  <form>
    <input type="button" onclick="history.back()" value="戻る">
  </form>

</body>
</html>