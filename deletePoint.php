<?php

function delPoint($mID) {
    
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
        //該当メンバーの位置情報を削除する
        $sql = "DELETE FROM point WHERE memberID = :MID";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':MID',  $mID,  PDO::PARAM_STR );
        $stmh->execute();
        $pdo->commit();

    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー：" . $Exception->getMessage()."<BR>";
    }
}

delPoint($_POST['mID']);

?>
