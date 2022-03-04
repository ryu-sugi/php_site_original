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

  <div class="container">
    <h3 class="my-5 d-flex justify-content-center">カートの中身</h3>
    <div class="d-flex justify-content-center">
      <div class="col-md-6">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ボタン</th>
                <th>商品名</th>
                <th>商品画像</th>
                <th>価格</th>
              </tr>
            </thead>
            <tbody>

          <form method="post" action="pro_branch.php">
            <?PHP while (true) { ?>
              <?PHP $rec = $stmt->fetch(PDO::FETCH_ASSOC) ?>
              <?PHP if ($rec == false) { ?>
                <?PHP break; ?>
              <?PHP  } ?>
              <tr>
                <td> <?PHP print '<input type="radio" name="procode" value="' . $rec['code'] . '">' ?> </td>
                <td> <?PHP print $rec['name'] ?>
                <td> <?PHP print '<img src="../product/gazou/' . $rec['gazou'] . '">' ?> </td>
                <td> <?PHP print $rec['price'] . '円' ?> </td>
              </tr>
            <?PHP  } ?>
        </tbody>
      </div>
    </div>

      <div class="my-5 d-flex justify-content-center ">
        <input class="d-grid btn btn-primary mx-2 pt-2 " type="submit" name="disp" value="参照">
        <input class="d-grid btn btn-primary mx-2 pt-2 " type="submit" name="add" value="追加">
        <input class="d-grid btn btn-primary mx-2 pt-2 " type="submit" name="edit" value="修正">
        <input class="d-grid btn btn-primary mx-2 pt-2 " type="submit" name="delete" value="削除">
      </div>
    </form>

  <!-- <footer class="">
    <ul class="d-flex justify-content-center list-unstyled">
      <li><a href="index.html">トップページ</a></li>
      <li><a href="product/pro_list.php">商品一覧</a></li>
      <li><a href="shop/shop_list.php">購入する為の画面</a></li>
    </ul>
    <small>Copyright&copy; Ryuji </small>
  </footer> -->

  </div>
</body>

</html>