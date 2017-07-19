<html>
<head>
    <title>ログイン</title>
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
    $sql = "SELECT accountname, username, password FROM user WHERE accountname = :accountname";
    //プリペアードステートメントで実行準備をする。
    $stmh = $pdo->prepare($sql);
    //プレースホルダーに設定する値を指示
    $stmh->bindValue(':accountname',  $_POST['accountname'],  PDO::PARAM_STR );
    //ステートメントを実行する
    //$stmh->execute();
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
                $_SESSION['username']=$result['username'];
                //topページに強制移動
                header("Location: mypage.php");
            }else{
                print "ユーザ名かパスワードが違います。"."<BR>";
            }
        }else{
            print "ユーザ名かパスワードが違います"."<BR>";
        }

    }else{
        print "データが取得できませんでした。"."<BR>";
    }

    //コミット
    $pdo->commit();
} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage()."<BR>";
    print "ユーザ名かパスワードが違います。"."<BR>";
}

?>
<input type = "button" onclick = "location.href = 'top.html'" value ="トップに戻る">
</body>
</html>
