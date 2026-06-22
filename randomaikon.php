<!-- アイコンをランダム変更 -->
<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])){                               #　セッション内にuser_idが無い場合はログインページに強制遷移
    header("Location: login.php");
    exit;
}

$aikon_list = [                                                 # ランダムなアイコンリスト
    "cat1.png",
    "cat2.png",
    "cat3.png",
    "cat4.png",
    "cat5.png",
    "cat6.png"
];

$random_cat = "";                                               # アイコンが選択されていない場合空白を入れる(エラー対策)

if(isset($_POST["random"])){                                    # ランダムボタンが押された場合、aikon_listからランダムにアイコンを選ぶ
    $random_cat = $aikon_list[array_rand($aikon_list)];         
    $_SESSION["selected_aikon"] = $random_cat;                  # ランダムで選ばれたアイコンをセッションに保存
}

if(isset($_POST["decision"])){                                  # 決定ボタンが押された場合、セッションに保存されたアイコンをDBに保存
    $select_cat = $_SESSION["selected_aikon"];

    $sql = "UPDATE users                                        
            SET aikon = ?                                       
            WHERE id = ?";                                      

    $stmt = $pdo->prepare($sql);                                # SQL文を準備
    $stmt->execute([                                            # SQL文を実行
        $select_cat,                                            # SQLの一個目の?にセッションに保存されたアイコンを入れる
        $_SESSION["user_id"]                                    # SQLの二個目の?にセッション内のuser_idを入れる
    ]);

    header("Location: plof.php");                               # プロフページに強制遷移
    exit;                                                       # プロフページに遷移後の、PHPの処理を止める
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
    body{                                                       /* ページ全体のスタイル */
	padding:20px;
	padding-bottom:60px;
	background-color:#E6E6E6;
	color:#502613;
	}
	
	button{                                                     /* ボタンのスタイル */
	    background-color:#FFdbed;
	    color:#502613;
        outline:none;
	    width:auto;
	    height:auto;
	    border-radius:10%;
          }

        footer{                                                 /* フッターのスタイル */
	    position:fixed;                                         /* フッターを画面の下に固定 */
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

    <?php if(isset($_SESSION["selected_aikon"])){ ?>            <!-- セッションにアイコンが保存されている場合、選ばれたアイコンを表示 -->
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
