<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$aikon_list = [
    "cat1.png",
    "cat2.png",
    "cat3.png",
    "cat4.png",
    "cat5.png",
    "cat6.png"
];

$random_cat = "";

if(isset($_POST["random"])){
    $random_cat = $aikon_list[array_rand($aikon_list)];
    $_SESSION["selected_aikon"] = $random_cat;
}

if(isset($_POST["decision"])){
    $select_cat = $_SESSION["selected_aikon"];

    $sql = "UPDATE users
            SET aikon = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $select_cat,
        $_SESSION["user_id"]
    ]);

    header("Location: plof.php");
    exit;
}
?>    
<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset ="UFT-8">
<title>ランダムアイコン設定</title>
    
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
    <h1>アイコン設定</h1>

    <form method="post">
        <button name="random" type="submit">ランダム選択</button>
    </form>

    <?php if(isset($_SESSION["selected_aikon"])){ ?>
        <img src="<?php echo $_SESSION["selected_aikon"]; ?>" width="100">
    <?php } ?>

    <form method="post">
        <button name="decision" type="submit">このアイコンに決定</button>
    </form>

    <footer>
            <table>
            <tr>
	    <td><button onclick="location.href='http://localhost/main.php'">メインページ</button></td>
            <td><button onclick="location.href='http://localhost/plof.php'">プロフィール</button></td>
	    <td><button onclick="location.href='http://localhost/edit_plof.php'">プロフィール編集</button></td>
            </tr>
         </table>
    </footer>

</body>

</html>