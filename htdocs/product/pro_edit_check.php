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

  <?php

$pro_code = $_POST['code'];
$pro_name = $_POST['name'];
$pro_price = $_POST['price'];
$pro_gazou_old = $_POST['gazou_gazou_old'];
$pro_gazou = $_FILES['gazou'];

$pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
$pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
$pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

print '<div class="container">';
print '<div class="text-center mt-5">';

    if($pro_name=='')
    {
      print '商品名が入力されていません。<br>';
    }
    else
    {
      print '商品名_';
      print $pro_name;
      print '<br>';
    }

    if(preg_match("/^[0-9]+$/", $pro_price)==0)
    {
      print '価格を正しく入力してください。 <br>';
    }
    else
    {
      print '価格_';
      print $pro_price;
      print '円 <br>';
    }

    if($pro_gazou['size']>0)
    {
      if($pro_gazou['size']>1000000)
      {
        print '画像が大きすぎます。';
      }
      else
      {
        move_uploaded_file($pro_gazou['tmp_name'],'../product/gazou/'.$pro_gazou['name']);
        print '<img src="../product/gazou/'.$pro_gazou['name'].'">';
        print '<br>';
      }
    }

    if($pro_name==''||preg_match("/^[0-9]+$/", $pro_price)==0||$pro_gazou['size'] > 1000000)
    {
      print '<form>';
      print '<input type="button" onclick="history.back() value="戻る">';
      print '</form>';
    }
    else
    {
      print '上記のように変更します。 <br>';
      print '<form method="post" action="pro_edit_done.php">';
      print '<input type="hidden" name="code" value="'.$pro_code.'">';
      print '<input type="hidden" name="name" value="'.$pro_name.'">';
      print '<input type="hidden" name="price" value="'.$pro_price.'">';
      print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
      print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
      print '<br/>';
      print '<br/>';
      print '<div class="my-2 d-flex justify-content-center ">';
      print '<input class="ml-3 d-grid btn btn-primary text-white" type="button" onclick="history.back"()" value="戻る">';
      print '<input class="ml-3 d-grid btn btn-primary text-white mx-2" type="submit" value="OK">';
      print '</div>';
      print '</form>';   
    }
    
  ?>

<footer class="fixed-bottom">
      <ul class="d-flex justify-content-center list-unstyled">
        <li><a href="index.html">トップページ</a></li>
        <li><a href="product/pro_list.php">商品一覧</a></li>
        <li><a href="shop/shop_list.php">購入する為の画面</a></li>
      </ul>
      <small>Copyright&copy; Ryuji</small>
    </footer>


  </div>
</body>
</html>