<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>PHP SHOP SITE TOP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="ここにサイト説明を入れます" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
  <form>
    <div id="container">
      <header>
        <h1><a href="index.html">PHP 雑貨 サイト</a></h1>
      </header>

      <nav id="menubar">
        <ul>
          <li><a href="index.php">トップページ</a></li>
          <li><a href="shop/shop_list.php">商品一覧</a></li>
          <li><a href="product/pro_list.php">商品管理</a></li>
        </ul>
      </nav>

      <div class="mainimg">
        <div><img src="product/gazou/mainvisual01.jpg" style="width: 100%;" /></div>
      </div>

      <main>
      <h2 class="">商品一覧</h2>
        <div class="product-index">
          <?PHP while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
              break;
            } ?>
            <?PHP print '<a href="shop_product.php?procode=' . $rec['code'] . '">' ?>
            <?PHP print $rec['name'] . '：' ?>
            <?PHP print $rec['price'] . '円' ?>
            <?PHP print '<img src="product/gazou/' . $rec['gazou'] . '">' ?>
            </a>
            <br />
            <br>
          <?PHP } ?>
          <a  href="shop_cartlook.php">カートを見る</a><br>
        </div>
      </main>

      <footer class="footer">
        <ul class="icon">
          <ul>
            <li><a href="index.html">トップページ</a></li>
            <li><a href="product/pro_list.php">商品一覧</a></li>
            <li><a href="shop/shop_list.php">購入する為の画面</a></li>
          </ul>

        </ul>
        <small>Copyright&copy; Ryuji </small>
      </footer>
    </div>
</body>

</html>