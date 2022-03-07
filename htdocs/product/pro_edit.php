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

    $pro_code = $_GET['procode'];

    $dsn = 'mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_gazou_name_old = $rec['gazou'];

    $dbh = null;

    if ($pro_gazou_name_old == '') {
      $disp_gazou = '';
    } else {
      $disp_gazou = '<img src="../product/gazou/' . $pro_gazou_name_old . '">';
    }
  } catch (Exception $e) {
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
    <h3 class="text-cart my-5 d-flex justify-content-center">商品修正</h3>
    <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
      <input type="hidden" name="code" value="<?php print $pro_code; ?>">
      <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
    <div class="d-flex align-items-center justify-content-center">
      <div class="col-md-6">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>商品コード</th>
              <th>商品名</th>
              <th>価格</th>
              <th>画像</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td> <?php print $pro_code; ?></td>
                <td> <input type="text" name="name" value="<?php print $pro_name; ?>"> </td>
                <td> <input type="text" name="price" value="<?php print $pro_price; ?>">円 </td>
                <td> <?php print $disp_gazou; ?>
                  <br> 画像を選んでください。
                  <br> <input type="file" name="gazou">
                </td>
              </tr>
            </tbody>
          </table>
          <div class="my-5 d-flex justify-content-center ">
            <input class="ml-3 d-grid btn btn-primary text-white" type="button" onclick="history.back()" value="戻る">
            <input class="ml-3 d-grid btn btn-primary text-white mx-2" t type="submit" value="OK">
          </div>
        </form>
      </div>
    </div>



  </div>
  </div>
  </div>

</body>

</html>