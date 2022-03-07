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
      <li><a href="shop/shop_cartlook.php">カート(購入)</a></li>
      <li><a href="shop/shop_list.php">商品一覧</a></li>
      <li><a href="product/pro_list.php">商品管理</a></li>
    </ul>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h3 class=" text-pro d-flex justify-content-center mb-4">商品追加</h3>
        <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
          <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="商品名を入力してください" value="">
          </div>
          <div class="mb-3 mt-5">
            <input type="text" class="form-control" name="price" placeholder="価格を入力してください" value="">
          </div>
          <div class="border text-center mt-5">
            <div class="mb-3 border-bottom">
              画像選択
            </div>
            <input type="file" name="gazou">
          </div>
          <div class="d-flex justify-content-around mt-5">
            <input type="button" class="btn btn-primary" onclick="history.back()" value="戻る">
            <input type="submit" class="btn btn-primary" value="OK">
          </div>
        </form>
      </div>
    </div>
  </div>

<footer class="fixed-bottom">
  <ul class="d-flex justify-content-center list-unstyled">
    <li><a href="index.html">トップページ</a></li>
    <li><a href="product/pro_list.php">商品一覧</a></li>
    <li><a href="shop/shop_list.php">購入する為の画面</a></li>
  </ul>

  </ul>
  <small>Copyright&copy; Ryuji </small>
</footer>


</html>