<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $num = $_POST["num"];

    $sql = "DELETE FROM post
            WHERE num = ?
            AND user_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $num,
        $_SESSION['user_id']
    ]);
}

header("Location: plof.php");
exit;
?>