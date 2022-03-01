<?PHP
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
  print 'ようこそゲスト様';
  print '<a href="member_login.html">会員ログイン</a><br>';
  print '<br>';
} else {
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
  <link rel="stylesheet" href="css/style.css" />
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
<div class="mx-auto" style="width: 200px;">
  <h3 class="bg-secondary text-white">カートの中身</h3>
  <div class="col-5 ml-3">
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
        <?PHP for ($i = 0; $i < $max; $i++) { ?>
      </thead>
      <tbody>
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

  <input type="hidden" name="max" value="<?PHP print $max; ?>">
  <input type="button" class="bg-secondary text-white" class="" onclick="history.back()" value="戻る">
  <input type="submit" class="bg-secondary text-white" value="数量変更"> <br>
</form>
<br>
<button type="button" class="btn btn-secondary">
  <a href="shop_form.html" class="text-white text-decoration-none">ご購入手続きへ進む</a>
  </button>
</body>

</html>