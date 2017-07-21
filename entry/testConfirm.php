<html>
<head>
  <title>登録完了</title>
  <link href = "css/bootstrap.min.css" rel = "stylesheet">
</head>
<body>
  <?php
  //configファイルを読み込む
  require_once('config.php');

  $dsn = db_type.":host=".db_host.";dbname=".db_name.";charset=utf8";

  //dbに接続
  try{
      $pdo = new PDO($dsn,db_user,db_pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch(Exception $Exception) {
      die('エラー :' . $Exception->getMessage());
  }
  try{
    $pdo->beginTransaction();
    $sql = "INSERT INTO user (accountname, username, password) VALUES(:accountname, :username, :password)";
    $sel_sql = "SELECT accountname FROM user WHERE accountname = :accountname";

    $stmh = $pdo -> prepare($sql);
    $select = $pdo -> prepare($sel_sql);

    $stmh -> bindValue(':accountname', $_POST['accountname'], PDO::PARAM_STR);
    $stmh -> bindValue(':username', $_POST['username'], PDO::PARAM_STR);

    $select -> bindValue(':accountname', $_POST['accountname'], PDO::PARAM_STR);
    $select -> execute();
    $result = $select->fetch();
  }catch(PDOException $Exception){
    $pdo->rollBack();
    //print "エラー：" . $Exception->getMessage()."<BR>";
  }

  if(empty($result)){
    //入力したパスワードを拾う
    $hashValue = password_hash( $_POST['password'] , PASSWORD_DEFAULT); //ハッシュ化
    $stmh->bindValue(':password',  $hashValue,  PDO::PARAM_STR );
    //ステートメントを実行する
    $stmh->execute();
    //コミット
    $pdo->commit();
  ?>

  <div class="text-center" style="font-size:xx-large; margin-top:150px;">
  <p>登録が完了しました！</p>
  </div>
  <div class="text-center" style="font-size:x-large;">
  <p>引き続き、本サービスをご利用ください。</p>
  </div>

  <form name="form1" action="../top/top.html">
    <div class="panel panel-primary"
      style="position:absoluto;
  	         top:50%;left:50%;
  	         width:402px;
  	         margin-left:475px;
  	         margin-top:100px;">
      <button id="btn" name="btn" type="submit" class="btn btn-lg" style="width:400px">トップページへ</button>
    </div>
  </form>

  <?php
  }else{
  ?>
  <div class="text-center" style="font-size:x-large; margin-top:150px;">
  <p>申し訳ございません。希望のアカウント名は既に使用されています。</p><BR>
  <p>別のアカウント名を使用してください。</p>
  </div>

  <form name="form1" action="entry.html">
    <div class="panel panel-primary"
      style="position:absoluto;
	           top:50%;left:50%;
	           width:402px;
	           margin-left:475px;
	           margin-top:100px;">
      <button id="btn" name="btn" type="submit" class="btn btn-lg" style="width:400px">戻る</button>
    </div>
  </form>
  <?php
  }
  ?>

</body>
</html>
