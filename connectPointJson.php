<?php

function getOtherPoint($mID){
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
        //自分以外の人の位置情報を取得
        $sql = "SELECT * FROM point WHERE memberID != :MID";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':MID',  $mID,  PDO::PARAM_INT );
        $stmh->execute();
        $result = $stmh->fetchAll();
        $pdo->commit();

        print json_encode($result,JSON_UNESCAPED_SLASHES);

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
}

getOtherPoint($_GET['mID']);

?>
