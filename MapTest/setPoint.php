<?php

function setPoint($mID,$lat,$lon) {
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
        
        $pdo->beginTransaction();
        //メンバーIDと位置を登録
        $sql = "DELETE FROM point WHERE memberID = :MID";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':MID',  $mID,  PDO::PARAM_STR );
        //ステートメントを実行する
        $stmh->execute();
        //コミット
        $pdo->commit();

        
        $pdo->beginTransaction();
        //メンバーIDと位置を登録
        $sql = "INSERT INTO point (memberID,latitude,longitude) VALUES (:MID, :lat , :lon)";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':MID',  $mID,  PDO::PARAM_STR );
        $stmh->bindValue(':lat',  $lat,  PDO::PARAM_STR );
        $stmh->bindValue(':lon',  $lon,  PDO::PARAM_STR );
        //ステートメントを実行する
        $stmh->execute();
        $result = $stmh->fetchAll();
        //コミット
        $pdo->commit();

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
}



setPoint($_POST['mID'], $_POST['lat'], $_POST['lon']);
//setPoint(4, 33.8356194, 132.7598677);
//33.8356194,132.7598677

?>
