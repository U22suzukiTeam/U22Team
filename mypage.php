<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>マイページ</title>
	<link rel="stylesheet" href="mypage.css" type="text/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!--
	<img id="logo" src="images/logo.png" alt="待ち合わせするんです"width="400" height="80">
-->
<div class="col-xs-offset-4 col-xs-4" style="margin-top:150px;">
  <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES); ?></u>さん</p><br>

  <form action="createLoom.php" onsubmit="return Checkposition()">
	<input class="button" type="submit" value="ルーム作成">
  </form>

  <form action="Logout.php">
	<input class="button" type="submit" value="ログアウト">
  </form>
</div>

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
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>

