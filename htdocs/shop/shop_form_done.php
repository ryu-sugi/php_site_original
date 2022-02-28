<?PHP 
  session_start();
  session_regenerate_id();
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
  <?PHP 

  try {

    require_once('../common/common.php');

    $post=sanitize($_POST);

    $onamae=$post['onamae'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];

    print $onamae. '様 <br>';
    print 'ご注文ありがとうございました。 <br>';
    print $email. 'にメールを送りましたのでご確認ください。 <br>';
    print '商品は以下の住所に発送いたします。 <br>';
    print $postal1.'-'.$postal2. '<br>';
    print $address. '<br>';
    print $tel. '<br>';
    
    $cart= $_SESSION['cart'];
    $kazu= $_SESSION['kazu'];
    $kakaku = $_SESSION['price'];

    $max= count($cart);

    $dsn='mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  for($i=0; $i<$max; $i++) {

    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $cart[$i];
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $rec['name'];
    $price = $rec['price'];
    $kakaku[] = $price;
    $suryo = $kazu[$i];
    $shokei = $price * $suryo;

    $honbun.=$name.' ';
    $honbun.=$price.'円x';
    $honbun.=$suryo.'個 =';
    $honbun.=$shokei."円 <br>";
  }

    $sql = 'INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = 0;
    $data[] = $onamae;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;
    $stmt->execute($data);
  
    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode=$rec['LAST_INSERT_ID()'];

    for($i=0; $i<$max; $i++) {
      $sql = 'INSERT INTO dat_sales_product(code_sales,price,quantity) VALUES(?,?,?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = $lastcode;
      $data[] = $cart[$i];
      $data[] = $kakaku[$i];
      $data[] = $kazu[$i];
      $stmt->execute($data);
    }

    $dbh=null;

  }
  catch(Exception $e)
  {
      print $e;
      exit();
  }
  
  ?>
</body>
</html>