<?php 
session_start();
require 'db.php';

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
date_default_timezone_set('Asia/Tokyo');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $tweet = $_POST["tweet"];
    $user_id = $_SESSION["user_id"];

    $day = date("Y-m-d");
    $time = date("H:i");

    $sql = "INSERT INTO post (user_id, tweet, day, time)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $tweet, $day, $time]);

    header("Location: plof.php");
    exit;
    }
?>
 
<!DOCTYPE html>
<html lang = "ja">

<head>
<meta charset ="UFT-8">
<title>tweet</title>
    
    <meta charset ="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>


<style>
    body{
	padding:20px;
	padding-bottom:60px;
	background-color:#E6E6E6;
	color:#502613;
	}
	
	button{
	    background-color:#FFdbed;
	    color:#502613;
            outline:none;
	    width:auto;
	    height:auto;
	    border-radius:10%;
          }

        footer{
	    position:fixed;
	    bottom:0;
	    left:0;
	    width:100%;
	}

</style>

<body>
    <p>投稿する</p>
    <p></p>
    <form method = "post">
        <textarea name = "tweet"  rows = "5" col= "600" maxlength ="500"></textarea>
        <p></p>
        <button type = "submit">投稿</button>
	<p></p>
    <td><button onclick="location.href='http://localhost/plof.php'">プロフィール</button></td>
    </form>

</body>

</html>