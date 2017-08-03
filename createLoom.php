<?php
require_once('config.php'); //DB設定
require_once('functions.php'); //DB接続用

session_start();

date_default_timezone_set('Asia/Tokyo');

//$errorMessage = "";

//年月日時分秒
$today = date("Ymdhis");

//ユーザー名+時間
$address = $_SESSION["username"] . $today;


$url = "http://150.95.140.30/U22Team/room/index.html?address=". $address;

$localurl = "http://localhost/U22Team/room/index.html?address=". $address;

//DB接続
$pdo = connectDb();

try {

	$stmt = $pdo->prepare("INSERT INTO rooms(address) VALUES (?)");
        $stmt->execute(array($address));

	//ルーム画面に遷移
	header("Location: ". $localurl);
	exit;

} catch (PDOException $e) {
	//ここはエラーメッセージ表示の方がいいかもしれない
	header("Location: dberror.html");
	exit;
}

?>
