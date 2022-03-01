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

    $dsn = 'mysql:dbname=shop;host=172.18.0.2;port=3306;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    print '商品一覧 <br /><br />';
    $dbh = null;
  } catch (Exception $e) {
    print $e;
    exit();
  }
  ?>
      <form method="post" action="pro_branch.php">
        <div class="input-group">
          <div class="input-group-prepend">
          <div class="input-group-text">
            <?PHP while (true) { ?>
              <?PHP $rec = $stmt->fetch(PDO::FETCH_ASSOC) ?>
              <?PHP if ($rec == false) { ?>
                <?PHP break; ?>
                <?PHP  } ?>
      <?PHP print '<input type="radio" aria-label="Radio button for following text input" name="procode" value="' . $rec['code'] . '">' ?>
      <?PHP print $rec['name'] . '___' ?>
      <?PHP print $rec['price'] . '円' ?>
      <br />
      <?PHP  } ?>
    </div>
    </div>
    </div>
      <input type="submit" name="disp" value="参照">
      <input type="submit" name="add" value="追加">
      <input type="submit" name="edit" value="修正">
      <input type="submit" name="delete" value="削除">
  </form>

  <a href="../pro_login/pro_top.php">トップメニューへ</a> 

</body>