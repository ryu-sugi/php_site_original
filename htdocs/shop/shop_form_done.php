<?PHP 
  session_start();
  session_regenerate_id();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP SHOP SITE</title>
</head>
<body>
  <?PHP 
    require_once('../common/common.php');

    $post=sanitize($_POST);

    $onamae=$post['onamae'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];

    print $onamae. '様 <br>';
    print 'ご注文ありがとうございました。 <br>';
    print $email. 'にメールを送りましたのでご確認ください。 <br>';
    print '商品は以下の住所に発送いたします。 <br>';
    print $postal1.'-'.$postal2. '<br>';
    print $address. '<br>';
    print $tel. '<br>';
    
  ?>
</body>
</html>