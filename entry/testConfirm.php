<HTML>
<HEAD>

  <TITLE>登録完了</TITLE>
  <link href="css/bootstrap.min.css" rel="stylesheet">

</HEAD>
<BODY>
<?php

$db_user = "AAA";	// ユーザー名
$db_pass = "ju78iklo";	// パスワード
$db_host = "localhost";	// ホスト名
$db_name = "U22";	// データベース名
$db_type = "mysql";	// データベースの種類

$account = $_POST["accountname"];

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDO($dsn, $db_user,$db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  //print "接続しました... <br>";
} catch(PDOException $Exception) {
  die('エラー :' . $Exception->getMessage());
}

try {
  $pdo->beginTransaction();
//プレースホルダーを設定してSQL文を作る
  $sql = "INSERT  INTO user (accountname, username, password ) VALUES ( :accountname, :username, :password  )";
//プリペアードステートメントで実行準備をする。
  $stmh = $pdo->prepare($sql);
//プレースホルダーに設定する値を指示
  $stmh->bindValue(':accountname',  $account,  PDO::PARAM_STR );
  $stmh->bindValue(':username',  $_POST['username'],  PDO::PARAM_STR );
  
  $password = $_POST['password'];   //入力したパスワードを拾う
  $hashValue = password_hash( $password , PASSWORD_DEFAULT); //ハッシュ化
  $stmh->bindValue(':password',  $hashValue,  PDO::PARAM_STR );
    
//ステートメントを実行する
  $stmh->execute();
//コミット
  $pdo->commit();
  ?>
  
  <div class="center-block" style="width:200px">
  <p>登録が完了しました！</p>
  </div>
 
 <?php
}catch (PDOException $Exception) {
  $pdo->rollBack();
  //print "エラー：" . $Exception->getMessage();
  print "申し訳ございません。希望のアカウント名は既に使用されています。<BR>";
  print "別のアカウント名を使用してください。";
}
?>

<br><br><br>
<form name="form1" action="entry2.html">
  <div class="panel panel-primary"
    style="position:absoluto;
	top:50%;left:50%;
	width:402px;
	margin-left:350px;
	margin-top:150px;">
    <button id="btn" name="btn" type="submit" class="btn btn-lg" style="width:400px">トップページへ</button>
  </div>
</form>
  
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>