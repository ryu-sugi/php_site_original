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
  <link rel="stylesheet" href="../css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

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
      $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = $lastcode;
      $data[] = $cart[$i];
      $data[] = $kakaku[$i];
      $data[] = $kazu[$i];
      $stmt->execute($data);
    }

    $sql='UNLOCK TABLES';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $dbh=null;

  }
  catch(Exception $e)
  {
      print $e;
      exit();
  }
  
  ?>

<header>
    <h1><a class="bg-primary text-white rounded text-decoration-none" href="../index.php">PHP 雑貨 サイト</a></h1>
  </header>

  <nav id="menubar">
    <ul>
      <li><a href="../index.php">トップページ</a></li>
      <li><a href="../shop/shop_cartlook.php">カート(購入)</a></li>
      <li><a href="../shop/shop_list.php">商品一覧</a></li>
      <li><a href="../product/pro_list.php">商品管理</a></li>
    </ul>
  </nav>

  <div class="container">
    <h3 class="my-5 d-flex justify-content-center">ご注文ありがとうございました！</h3>
    <h5 class="d-flex justify-content-center">商品は以下の住所に発送いたします。</h5>
    <div class="d-flex align-items-center justify-content-center">
      <div class="col-md-6">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>お名前</th>
                <th>メール</th>
                <th>郵便番号</th>
                <th>住所</th>
                <th>電話番号</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <td><?PHP print $onamae. '様'?></td>
                <td> <?php print  $email. 'にメールを送りましたのでご確認ください。' ?></td>
                <td> <?php print $postal1.'-'.$postal2 ?> </td>
                <td> <?php print $address ?></td>
                <td> <?php print $tel  ?></td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>

    <div class="my-1 d-flex justify-content-center">
    <a class="d-grid btn btn-primary text-white" href="shop_list.php">商品画面へ</a>
    </div>


  <footer class="fixed-bottom">
      <ul class="d-flex justify-content-center list-unstyled">
        <li><a href="../index.html">トップページ</a></li>
        <li><a href="../product/pro_list.php">商品一覧</a></li>
        <li><a href="../shop/shop_list.php">購入する為の画面</a></li>
      </ul>
      <small>Copyright&copy; Ryuji</small>
    </footer>
  </div>
  
</div>
</body>
</html>