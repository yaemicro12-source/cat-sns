<!-- ユーザープロフィール -->
<?php
    session_start();
    require 'db.php';
    $id = $_GET['id'];                                                          # URLからユーザーIDを取得

    if(!isset($_SESSION['user_id'])){                                           # セッション内にuser_idが無い場合はログインページに強制遷移
        header("Location: login.php");
        exit;
    }

$sql = "SELECT name, profile, aikon
        FROM users
        WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['name'];
$profile = $user['profile'];
$aikon = $user['aikon'];                                                        # ユーザーのアイコン画像のファイル名を取得

    if($aikon == "cat1.png"){                                                   # ユーザーのアイコン画像に応じてヘッダー画像を変更
        $header = "header1.png";
    }elseif($aikon == "cat2.png"){
        $header = "header2.png";
    }elseif($aikon == "cat3.png"){
        $header = "header3.png";
    }elseif($aikon == "cat4.png"){
        $header = "header4.png";
    }elseif($aikon == "cat5.png"){
        $header = "header5.png";
    }elseif($aikon == "cat6.png"){
        $header = "header6.png";
    }else{
        $header = "header1.png";
    }

# ユーザーidに紐づく投稿をDBから取得し、降順に並べ替える
$sql = "SELECT num, tweet, day, time
        FROM post
        WHERE user_id = ?
        ORDER BY num DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset ="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Project app</title>
	<!-- Bootstrap -->
	<img class="header_img" src="<?php echo $header; ?>">
        <p></p>
	<table>
	    <td><img class="img-responsive" src="<?php echo $aikon; ?>" width="40" height="40"></td>
	    <td><h1><?php echo $name; ?></h1></td>
	    <td><p class="id">@<?php echo $id; ?></p></td>
	</table>
	<p class="profile"><?php echo $profile; ?></p>
</head>

<style>
		
	body{
		padding:20px;
		padding-bottom:60px;
		background-color:#E6E6E6;
		color:#502613;
	}

    .profile{
        margin-top:5px;
    }
	
	button{
	    background-color:#FFdbed;
	    color:#502613;
            outline:none;
	    width:auto;
	    height:auto;
	    border-radius:10%;
	      }
	
	.img-responsive{
	    border-radius:50%;
	    widrh:40px;
	    height:40px;
	}
	
	.id{
	    color:#B8C0F2;
	}
    
      .post_box{
           background-color:white;
           width:280px;
           border:1px solid #eee;
           margin:20px auto;
           padding:10px;
       }

       .aikon{
           width:50px;
           height:50px;
           border-radius:50%;
          border:1px solid #dde;
       }

       .post_plof{
           margin-bottom:10px;
       }
	
	footer{
	    position:fixed;
	    bottom:0;
	    left:0;
	    width:100%;
	}
    
    .header_img{
        width:100%;
        
        height:150px;
        object-fit:cover;
        display:block;
        margin:0 auto 10px auto;
        border-radius:10px;
    }
	
</style>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    	<p></p>
<?php if(count($posts) == 0){ ?>

    <p>まだ投稿がありません</p>

<?php }else{ ?>

    <?php foreach($posts as $post){ ?>                                             <!-- 投稿がある場合、foreachで投稿を1件ずつ表示する -->

        <div class="post_box">
            <table class="post_plof">
                <tr>
                    <td>
                        <img class="aikon" src="<?php echo $aikon; ?>">
                    </td>
                    <td>
                        <span><?php echo $name; ?></span>                           <!-- 投稿者の名前を表示 -->
                        <p class="id">@<?php echo $_SESSION['user_id']; ?></p>
                    </td>
                </tr>
            </table>

            <p><?php echo $post['tweet']; ?></p>

<small>                                                                             <!-- 投稿日時を小さく表示 -->
    <?php echo $post['day']; ?>
    <?php echo $post['time']; ?>
</small>

</div>

<?php } ?>

<?php } ?>

	<p></p>

<footer>
    <table>
        <tr>
        <td><button onclick="location.href='http://localhost/main.php'">メインページ</button></td>
        <td><button onclick="location.href='http://localhost/edit_prof.php'">プロフィール編集</button></td>
	<td><button onclick="location.href='http://localhost/tweet.php'">投稿する</button></td>
	<button onclick="location.href='http://localhost/logout.php'">ログアウト</button>
     </table>
        </tr>
</footer>
   
</body>
</html>
