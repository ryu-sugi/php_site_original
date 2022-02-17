<!DOCTYPE html>
<html lang="en">

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

  $dsn='mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
  $user = 'root';
  $password = 'password';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;


  print'商品一覧 <br /><br />';

  print'<form method="post" action="pro_branch.php">';
    while(true)
    {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
    break;
    }
    print'<input type="radio" name="procode" value="' .$rec['code'].'">';
    print$rec['name'].'___';
    print$rec['price'].'円';
    print'<br />';
    }
    print'<input type="submit" name="disp" value="参照">';
    print'<input type="submit" name="add" value="追加">';
    print'<input type="submit" name="edit" value="修正">';
    print'<input type="submit" name="delete" value="削除">';
    print'</form>';

  }
  catch(Exception $e)
  {
  print $e;
  exit();
  }

  ?>

  <br>
  <a href="../staff_login/staff_top.php">トップメニューへ</a> <br>

</body>