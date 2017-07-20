<html>
<head>

    <title>ログイン</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
<?php
//configファイルを読み込む
require_once('/config.php');

$dsn = db_type.":host=".db_host.";dbname=".db_name.";charset=utf8";

//dbに接続
try{
    $pdo = new PDO($dsn,db_user,db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(Exception $Exception) {
    die('エラー :' . $Exception->getMessage());
}

try {
    $pdo->beginTransaction();
    //プレースホルダーを設定してSQL文を作る
    $sql = "SELECT accountname , username , password FROM user WHERE accountname = :accountname";
    //プリペアードステートメントで実行準備をする。
    $stmh = $pdo->prepare($sql);
    //プレースホルダーに設定する値を指示
    $stmh->bindValue(':accountname',  $_POST['accountname'],  PDO::PARAM_STR );
    //ステートメントを実行する
    $stmh->execute();
    $result = $stmh->fetch();

    if(isset($result)){
        //ユーザ名が一致するか
        if($_POST['accountname'] == $result['accountname']){
            //ハッシュ化されたパスワードと一致するか
            $servedPass = $result['password'];
            $password = $_POST['password'];
            if(password_verify($password,$servedPass)){
                //セッション発行
                session_start();
                $_SESSION['username']=$_POST['username'];
                //topページに強制移動
                header("Location: mypage.php");
            }else{ 
				?>
				
				<div class="text-center" style="font-size:x-large; margin-top:150px;">
				  <p>申し訳ございません。アカウント名またはパスワードが違います。</p>
				</div>

				<form name="form1" action="top.html">
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
			
		}else{
			?>
   
			<div class="text-center" style="font-size:x-large; margin-top:150px;">
			  <p>申し訳ございません。アカウント名またはパスワードが違います。</p>
			</div>

			<form name="form1" action="top.html">
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

    }else{
    ?>

		<div class="text-center" style="font-size:x-large; margin-top:150px;">
	      <p>申し訳ございません。アカウント名またはパスワードが違います。</p>
		</div>

		<form name="form1" action="top.html">
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

    //コミット
    $pdo->commit();
} catch (PDOException $Exception) {
    $pdo->rollBack();
    //print "エラー：" . $Exception->getMessage()."<BR>";
    //print "アカウント名かパスワードが違います。"."<BR>";?>
	
	<div class="text-center" style="font-size:x-large; margin-top:150px;">
	  <p>申し訳ございません。アカウント名またはパスワードが違います。</p>
    </div>

	<form name="form1" action="top.html">
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

<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>