<?php
    session_start();
    require'db.php';
    ?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset ="UFT-8">
<title>ログイン</title>
    
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
	    	    height:8%;
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
    <h1>ログイン</h1>

        <form method = "POST">
        <input type = "text" name = "request_id" placeholder= "idを入力してください">
        <p></p>
        <input type = "text" name = "pass" size = "30" placeholder= "パスワードを入力してください">
        <button class ="registaration" type = "submit">送信</button>
        <?php
            $request_id = isset($_POST["request_id"]) ? $_POST["request_id"] : "";
	    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
         ?>
        </form>
	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST"){
                $sql = "SELECT pass,id FROM users WHERE id = ?";

               $stmt = $pdo->prepare($sql);
               $stmt->execute([$request_id]);

              $user = $stmt->fetch(PDO::FETCH_ASSOC);

		    if($user && $user['pass'] == $pass){
    		        echo "ログイン成功";
    		        $_SESSION['user_id']=$user['id'];
			 header("Location: plof.php");
     　　　　　exit;
		    }else{
    		        echo "ログイン失敗";
		    }
	    }
        ?>    
    <p></p>
    
<footer>
    <button onclick="location.href='http://localhost/make_id.php'">登録がまだの方はこちら</button>
     <p></p>
    <td><button onclick="location.href='http://localhost/main.php'">メインページ</button></td>
</footer>
</body>

</html>