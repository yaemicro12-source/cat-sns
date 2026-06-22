<!-- 投稿削除 --->
<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])){                   # セッション内にuser_idが無い場合はログインページに強制遷移
    header("Location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){           # 投稿削除ボタンが押された場合、DBから該当の投稿を削除

    $num = $_POST["num"];                           # 投稿番号を取得
    $sql = "DELETE FROM post
            WHERE num = ?
            AND user_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $num,
        $_SESSION['user_id']
    ]);
}

header("Location: plof.php");                       # 投稿削除後、プロフィールページに強制遷移
exit;
?>