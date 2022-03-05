<?PHP
session_start();
session_regenerate_id(true);
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

  <?php

  try {

    $dsn = 'mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;
  } catch (Exception $e) {
    print $e;
    exit();
  }
  ?>

  <header>
    <h1><a class="bg-primary text-white rounded-pill text-decoration-none" href="../index.php">PHP 雑貨 サイト</a></h1>
  </header>

  <nav id="menubar">
    <ul>
      <li><a href="../index.php">トップページ</a></li>
      <li><a href="../shop/shop_cartlook.php">カート(購入)</a></li>
      <li><a href="../shop/shop_list.php">出品商品一覧</a></li>
      <li><a href="../product/pro_list.php">商品管理</a></li>
    </ul>
  </nav>

  <main>
    <h2>商品一覧</h2>
    <div class="container-product mt-5">
      <div class="row">
        <div class="col-md-3 d-flex justify-content-center table ">
          <?PHP while (true) { ?>
            <?PHP $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
              break;
            } ?>
            <?PHP print '<a class="text-decoration-none " href="../shop/shop_product.php?procode=' . $rec['code'] . '">';
            '</a>' ?>
            <?PHP print ' <div class="border">' ?>
            <?PHP print '商品名 : ' . $rec['name'] ?>
            <?PHP print '</div>' ?>
            <?PHP print ' <div class="border">' ?>
            <?PHP print '<img src="../product/gazou/' . $rec['gazou'] . '">' ?>
            <?PHP print '</div>' ?>
            <?PHP print ' <div class="border">' ?>
            <?PHP print '価格 : ' . $rec['price'] . ' 円' ?>
            <?PHP print '</div>' ?>
          <?PHP } ?>
        </div>
      </div>
    </div>
    </div>
    <button type="button" class="d-flex d-grid btn btn-primary mx-auto mt-5">
      <a href="../shop/shop_cartlook.php" class="text-white text-decoration-none">カートを見る</a>
    </button>
  </main>

  <footer class="fixed-bottom">
    <ul class="d-flex justify-content-center list-unstyled">
      <li><a href="index.html">トップページ</a></li>
      <li><a href="product/pro_list.php">商品一覧</a></li>
      <li><a href="shop/shop_list.php">購入する為の画面</a></li>
    </ul>
    <small>Copyright&copy; Ryuji </small>
  </footer>
  </div>

</body>
</html>