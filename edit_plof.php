<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $profile = $_POST["profile"];

    $sql = "UPDATE users
            SET name = ?, profile = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $name,
        $profile,
        $_SESSION['user_id']
    ]);

    header("Location: plof.php");
    exit;
}

$sql = "SELECT name, profile
        FROM users
        WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset ="UFT-8">
<title>プロフィール編集</title>
    
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

	.change_aikon{
		    border-radius:0;
		    width:auto;
		    height:auto;
	    	    background-color:#FFdbed;
	    	    color:#502613;
          }

        footer{
	    position:fixed;
	    bottom:0;
	    left:0;
	    width:100%;
	}

</style>

<body>    
    <h1>プロフィール編集</h1>
        <button class="change_aikon" onclick="location.href='http://localhost/randomaikon.php'">ランダムにアイコンを変更する</button>
    <p>　</p>

  <form method="post">

    <p>ここに名前を入力してください</p>
    <input type="text"
       name="name"
       value="<?php echo $user['name']; ?>">

    <p></p>

    <p>ここに自己紹介を入力してください</p>
    <textarea name="profile"
          rows="3"
          cols="40"
          maxlength="120"><?php echo $user['profile']; ?></textarea>

    <p></p>

    <button type="submit">登録</button>

</form>    

    <footer >
            <table>
            <tr>
            <td><button onclick="location.href='http://localhost/main.php'">メインページ</button></td>
	    <td><button onclick="location.href='http://localhost/plof.php'">プロフィール</button></td>
            </tr>
         </table>
    </footer>

</body>

</html>