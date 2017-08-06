
<?php

function setDestination($rID,$lat,$lon) {
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
        //該当メンバーの前回の位置を削除
        $sql = "DELETE FROM destination WHERE roomID = :RID";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':RID',  $rID,  PDO::PARAM_INT );
        $stmh->execute();
        $pdo->commit();

        $pdo->beginTransaction();
        //メンバーIDと位置を登録
        $sql = "INSERT INTO destination (roomID,latitude,longitude) VALUES (:RID, :lat , :lon)";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':RID',  $rID,  PDO::PARAM_INT );
        $stmh->bindValue(':lat',  $lat,  PDO::PARAM_STR );
        $stmh->bindValue(':lon',  $lon,  PDO::PARAM_STR );
        $stmh->execute();
        $pdo->commit();

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
}


setPoint($_POST['rID'], $_POST['lat'], $_POST['lon']);

?>
