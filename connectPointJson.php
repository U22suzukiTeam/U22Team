<?php
    require_once('config.php');

    $dsn = db_type.":host=".db_host.";dbname=".db_name.";charset=utf8";

    try{
        $pdo = new PDO($dsn,db_user,db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(Exception $Exception) {
        die('エラー :' . $Exception->getMessage());
    }

    try {
        //dbにアクセス
        //要素をSELECT * FROM pointで持ってくる
        //jsonに変換、出力

        $pdo->beginTransaction();
        //プレースホルダーを設定してSQL文を作る
        $sql = "SELECT * FROM photo";
        //プリペアードステートメントで実行準備をする。
        $stmh = $pdo->prepare($sql);
        //プレースホルダーに設定する値を指示
        //ステートメントを実行する
        $stmh->execute();
        $result = $stmh->fetchAll();
        //コミット
        $pdo->commit();

        print json_encode($result,JSON_UNESCAPED_SLASHES);

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
?>
