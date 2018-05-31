<?php
    // サインイン処理
   session_start();
   require('dbconnect.php');

   $errors = array();

    if(!empty($_POST)) {

        $email = $_POST['input_email'];
        $password = $_POST['input_password'];

        if ($email == '') {
           $errors['email'] = 'blank';
       
       }
       else {

        if($password =="") {
            $errors['password'] = 'blank';
        }
        
        }

  $count = strlen($password);  //文字数を数える技
        if($password =='') {
            $errors['password'] = 'blank';
        }
        elseif ($count < 4 || 16 < $count) {  // 4文字未満または16文字より多い
           $errors['password'] = 'length';
        }


       if ($email != '' && $password != '') {
      $sql = 'SELECT * FROM `users` WHERE `email`=?';
      $data = array($email);      
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $record = $stmt->fetch(PDO::FETCH_ASSOC);

         $dbh = null;
    

      if ($record == false) {
                $errors['signin'] = 'failed';

            }else {
            $errors['signin'] = 'blank';
        }

      if (password_verify($password,$record['password'])){
  //認証成功
        echo "<h1>認証成功</h1>";
}else{
  //認証失敗
          $errors['siginin'] = 'failed';
}

        }
       }

       
  

  
          //timeline.phpに移動
          header("Location: timeline.php");
          exit();

        }else{
          $errors['signin'] = 'failed';
        }

   
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Learn SNS</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2 thumbnail">
        <h2 class="text-center content_header">サインイン</h2>
        <form method="POST" action="signin.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com"><?php if(isset($errors['signin']) && $errors['signin'] == 'blank') { ?>
            <p class="text-danger">メールアドレスを入力してください</p>
            <?php } ?>
            <?php if (isset($errors['email'])&& $errors['email']=='duplicate') {
           ?> <p class="text-danger">このメールアドレスはすでに使われております</p>
           <?php } ?>
            <?php if(isset($errors['signin']) && $errors['signin'] == 'failed') { ?>
              <p class="text-danger">サインインに失敗しました</p>
            <?php } ?>

          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="input_password" class="form-control" id="password" placeholder="4 ~ 16文字のパスワード"><?php if(isset($errors['password'])&& $errors['password']=='blank'){ ?>
            <p class="text-danger">パスワードを入力してください</p>
            <?php } ?>
            <?php if(isset($errors['password'])&& $errors['password']=='length'){ ?>
            <p class="text-danger">パスワードは4~16文字で入力してくださいね</p>
            <?php } ?>
          </div>
          <input type="submit" class="btn btn-info" value="サインイン">
        </form>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>
