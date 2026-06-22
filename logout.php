<!-- ログアウト処理 -->
<?php
session_start();

$_SESSION = [];

session_destroy();               # セッションの破棄

header("Location: login.php");
exit;
?>