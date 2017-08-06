<?php

function getOtherPoint($rID){
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
        $sql = "SELECT * FROM destination WHERE roomID = :RID";  //同ルームの目的地のみを取得
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':RID',  $rID,  PDO::PARAM_INT );
        $stmh->execute();
        $result = $stmh->fetchAll();
        $pdo->commit();

        print json_encode($result,JSON_UNESCAPED_SLASHES);

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
}

getOtherPoint($_GET['rID']);

?>
