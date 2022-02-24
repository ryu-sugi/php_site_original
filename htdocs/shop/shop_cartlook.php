<?PHP
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['member_login']) ==false) {
    print 'ようこそゲスト様';
    print '<a href="member_login.html">会員ログイン</a><br>';
    print '<br>';
  }
  else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout.php">ログアウト</a><br>';
    print '<br>';
  }
?>

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

    $cart=$_SESSION['cart'];
    $kazu=$_SESSION['kazu'];
    $max=count($cart);
    
    $dsn='mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user='root';
    $password='password';
    $dbh=new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($cart as $key=> $val) {
      $sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[0]=$val;
      $stmt->execute($data);

      $rec=$stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[]=$rec['name'];
      $pro_price[]=$rec['price'];
      if($rec['gazou']=='') {
        $pro_gazou='';
      } 
      else {
        $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
      }
    }
    $dbh=null;
    }
  catch (Exception $e)
  {
    print $e;
    exit();
  }

  ?>

  カートの中身 <br>
  <br>
  <form method="post" action="kazu_change.php">
    <?PHP for($i=0;$i<$max;$i++) { ?>
    <?PHP print $pro_name[$i]; ?>
    <?PHP print $pro_gazou[$i]; ?>
    <?PHP print $pro_price[$i]; ?>円
    <input type="text" name="kazu<?PHP print $i; ?>" value="<?PHP print $kazu[$i]; ?>">
    <?PHP print $kazu[$i];?>個
    <br>
    <?PHP } ?>
    <br>
    <input type="hidden" name="max" value="<?PHP print $max; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="数量変更"> <br>
  </form>

</body>
</html>
