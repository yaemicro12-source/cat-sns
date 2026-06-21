<?php
    require'db.php';
    $sql = "INSERT INTO users
                VALUES(?,?,?,?,?)";
    $stmt =$pdo ->prepare($sql);
  
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset ="UFT-8">
<title>アカウント作成</title>
    
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
    <h1>プロフィール登録</h1>
        <button onclick="location.href='http://localhost/randomaikon.php'">ランダムにアイコンを変更する</button>
    <p>　</p>

       
        <form method = "POST">
        <input type = "text" name = "id" placeholder= "idを入力してください">
        <p></p>
        <input type = "text" name = "pass" size = "30" placeholder= "パスワードを入力してください">
	<p></p>
        <input type = "text" name = "name" placeholder= "名前を入力してください">
	<p></p>
    	<p><br></p>

        <p>あなたについて自由にかいてみましょう</p>
        <textarea name = "profile"  rows = "3" col = "40" maxlength ="120"></textarea>
        <button class ="registaration" type = "submit">登録</button>
        <?php
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
	    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
            $name = isset($_POST["name"]) ? $_POST["name"] : "";
	    $profile = isset($_POST["profile"]) ? $_POST["profile"] : "";
	   $aikon = isset($_SESSION['user_aikon']) ? $_SESSION['user_aikon'] : "cat0.png";
           $stmt -> execute([$id, $pass, $name, $profile, $aikon]);
         
            if ($id !== "" && $pass !== "") {
               $auto_message = "今日から始めるよ！";

          $day = date("Y-m-d");
          $time = date("H:i");

          $sql_post = "INSERT INTO post (user_id, tweet, day, time)
             VALUES (?, ?, ?, ?)";

               $stmt_post = $pdo->prepare($sql_post);
               $stmt_post->execute([
                   $id,
                   $auto_message,
                   $day,
                   $time
               ]);
	    }
         ?>
	</form>
    
    <footer >
	    <button type="button" onclick="location.href='http://localhost/main.php'">メインページ</button>
    </footer>

</body>

</html>
