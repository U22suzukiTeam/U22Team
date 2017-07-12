<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>マイページ</title>
<link rel="stylesheet" href="mypage.css">
</head>
<body>

<div id="page">

<header>
  <img id="logo" src="images/logo.png" alt="待ち合わせするんです"width="400" height="80">
  <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>
  <nav>
     <ul>
	<li><a href="createLoom.php">ルーム作成</a></li>
	<li><a href="Logout.php">ログアウト</a></li>

     </ul>
  </nav>
</header>
</div>
</body>
</html>