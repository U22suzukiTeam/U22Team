<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>マイページ</title>
	<link rel="stylesheet" href="mypage.css" type="text/css">
</head>
<body>
	<img id="logo" src="images/logo.png" alt="待ち合わせするんです"width="400" height="80">

	<p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p><br>

<form action="createLoom.php" onsubmit="return Checkposition()">
	<input class="button" type="submit" value="ルーム作成">
</form>

<script type="text/javascript">
//位置情報が取得可能かどうか
function Checkposition(){
    	if (navigator.geolocation) {
		return true;
        } else {
		alert("位置情報が取得できませんでした。\n位置情報機能をONにしてください。");
               	return false;
        }
}
</script>

<form action="Logout.php">
	<input class="button" type="submit" value="ログアウト">
</form>

</body>
</html>

