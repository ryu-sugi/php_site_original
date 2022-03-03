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
    if ($_SESSION['cart'] == true) {

      $cart = $_SESSION['cart'];
      $kazu = $_SESSION['kazu'];
      $max = count($cart);
    } else {
      $max = 0;
    }

    if ($max == 0) {
      print 'カートに商品が入っていません。 <br>';
      print '<br>';
      print '<a href="shop_list.php">商品一覧へ戻る</a>';
      exit();
    }

    $dsn = 'mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($cart as $key => $val) {
      $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[0] = $val;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[] = $rec['name'];
      $pro_price[] = $rec['price'];
      if ($rec['gazou'] == '') {
        $pro_gazou[] = '';
      } else {
        $pro_gazou[] = '<img src="../product/gazou/' . $rec['gazou'] . '">';
      }
    }
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
      <li><a href="index.php">トップページ</a></li>
      <li><a href="shop/shop_cartlook.php">カート(購入)</a></li>
      <li><a href="shop/shop_list.php">商品一覧</a></li>
      <li><a href="product/pro_list.php">商品管理</a></li>
    </ul>
  </nav>

  <div class="container">
    <h3 class="my-5 d-flex justify-content-center">カートの中身</h3>
    <div class="d-flex align-items-center justify-content-center">
      <div class="col-md-6">
        <form method="post" action="kazu_change.php">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>商品</th>
                <th>商品画像</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
                <th>削除</th>
              </tr>
            </thead>
            <tbody>
              <?PHP for ($i = 0; $i < $max; $i++) { ?>
                <tr>
                  <td> <?PHP print $pro_name[$i]; ?> </td>
                  <td> <?PHP print $pro_gazou[$i]; ?> </td>
                  <td> <?PHP print $pro_price[$i]; ?>円 </td>
                  <td> <input type="text" name="kazu<?PHP print $i; ?>" value="<?PHP print $kazu[$i]; ?>"> </td>
                  <td> 合計<?PHP print $pro_price[$i] * $kazu[$i]; ?>円 </td>
                  <td> <input type="checkbox" name="sakujo<?PHP print $i; ?>"> </td>
                </tr>
              <?PHP } ?>
            </tbody>
          </table>
      </div>
    </div>
    <div class="my-5 d-flex justify-content-center ">
      <input type="hidden" name="max" value="<?PHP print $max; ?>">
      <input type="submit" class="ml-3 d-grid btn btn-primary text-white" value="数量変更"> <br>
      <input type="button" class="ml-3 d-grid btn btn-primary text-white mx-2 " onclick="history.back()" value="戻る">
      <br>
      </form>
      <button type="button" class="d-grid btn btn-primary mx-2 pt-2">
        <a href="shop_form.html" class="text-white text-decoration-none">ご購入手続きへ進む</a>
      </button>
    </div>

    <footer>
      <ul class="d-flex justify-content-center list-unstyled">
        <li><a href="index.html">トップページ</a></li>
        <li><a href="product/pro_list.php">商品一覧</a></li>
        <li><a href="shop/shop_list.php">購入する為の画面</a></li>
      </ul>
      <small>Copyright&copy; Ryuji </small>
    </footer>
  </div>
  </div>

</body>
</html>