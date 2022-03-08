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
  require_once('../common/common.php');

  $post = sanitize($_POST);

  $onamae = $post['onamae'];
  $email = $post['email'];
  $postal1 = $post['postal1'];
  $postal2 = $post['postal2'];
  $address = $post['address'];
  $tel = $post['tel'];

  ?>

  <header>
  <h1><a class="bg-primary text-white rounded text-decoration-none" href="../index.php">PHP 雑貨 サイト</a></h1>
  </header>

  <nav id="menubar">
    <ul>
      <li><a href="../index.php">トップページ</a></li>
      <li><a href="shop/shop_cartlook.php">カート(購入)</a></li>
      <li><a href="shop/shop_list.php">商品一覧</a></li>
      <li><a href="product/pro_list.php">商品管理</a></li>
    </ul>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h3 class=" text-pro d-flex justify-content-center mb-4">購入確認画面</h3>
        <h4 class="mb-4 text-center">お間違いがないかご確認ください</h4>
        <ul class="list-group">
          <li class="list-group-item border-2">

            <?PHP $okflg = true; ?>
            <?PHP if ($onamae == '') {
              print 'お名前が入力されていません。 <br> <br>';
              $okflg = false;
            } else {
              print '<div class="border-bottom">【お名前】</div> ';
              print $onamae;
            } ?>
          </li>
          <li class="list-group-item border-2">
            <?PHP if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/', $email) == 0) {
              print 'メールアドレスを正確に入力してください';
              $okflg = false;
            } else {
              print '<div class="border-bottom">【メールアドレス】</div> ';
              print $email;
            } ?>
          <li class="list-group-item border-2">
            <?PHP if (preg_match('/^[0-9]+$/', $postal1) == 0) {
              if (preg_match('/^[0-9]+$/', $postal2) == 0)
                print '郵便番号は半角数字で入力してください。';
              $okflg = false;
            } else {
              print '<div class="border-bottom">【郵便番号】</div> ';
              print $postal1;
              print '-';
              print $postal2;
            } ?>
          </li>
          <li class=" list-group-item border-2">
            <?PHP if ($address == '') {
              print '住所が入力されていません。';
              $okflg = false;
            } else {
              print '<div class="border-bottom">【住所】</div> ';
              print $address;
            } ?>
          </li>
          <li class="list-group-item border-2">
            <?PHP if (preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/', $tel) == 0) {
              print '電話番号を正確に入力してください。';
              $okflg = false;
            } else {
              print '<div class="border-bottom">【電話番号】</div> ';
              print $tel;
            } ?>
          </li>
          </ul>
<?PHP if ($okflg == true) {
    print '<form method="post" action="shop_form_done.php">';
    print '<input type="hidden" name="onamae" value="' . $onamae . '">';
    print '<input type="hidden" name="email" value="' . $email . '">';
    print '<input type="hidden" name="postal1" value="' . $postal1 . '">';
    print '<input type="hidden" name="postal2" value="' . $postal2 . '">';
    print '<input type="hidden" name="address" value="' . $address . '">';
    print '<input type="hidden" name="tel" value="' . $tel . '">';
    print '<div class="d-flex justify-content-center justify-content-around mt-3 ">';
    print '<input class="btn btn-primary type="button" onclick="history.back()" value="戻る">';
    print '<input class="btn btn-primary"  type="submit" value="OK">';
    print '</div>';
    print '</form>';
    } else {
    print '<form>';
    print '<input class="btn btn-primary type="button" type="button" onclick="history.back()" value="戻る">';
    print '</form>';
    } ?>
      </div>
    </div>
  </div>

  <footer class="">
    <ul class="d-flex justify-content-center list-unstyled">
      <li><a href="index.html">トップページ</a></li>
      <li><a href="product/pro_list.php">商品一覧</a></li>
      <li><a href="shop/shop_list.php">購入する為の画面</a></li>
    </ul>
    
  </ul>
  <small>Copyright&copy; Ryuji </small>
</footer>
</body>

</html>