<!-- メインページ -->
<?php
session_start();
require 'db.php';

# post.user_id とusers.id が同じユーザー同士を結び付ける
$sql = "SELECT post.user_id, post.tweet, post.day, post.time, users.name, users.aikon
        FROM post
        JOIN users
        ON post.user_id = users.id
        ORDER BY post.num DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset ="UFT-8">
<title>メインページ</title>
    
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
	      }

        footer{
	    position:fixed;
	    bottom:0;
	    left:0;
	    width:100%;
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

    .id{
        color:#B8C0F2;
    }

</style>

<body>
      <h1>メインページ</h1>

        <?php foreach($posts as $post){ ?>                                    <!-- 投稿がある場合、foreachで投稿を1件ずつ表示する -->

        <div class="post_box">
        <table class="post_plof">
        <tr>
            <td>
                <img class="aikon" src="<?php echo $post['aikon']; ?>">     <!-- 投稿者のアイコンを表示 -->
            </td>
            <td>
                 <a href="user.php?id=<?php echo $post['user_id']; ?>">     <!-- 投稿者の名前をクリックすると、ユーザーのプロフィールページに遷移する -->
                 <?php echo $post['name']; ?>
                 </a>
                <p class="id">@<?php echo $post['user_id']; ?></p>          <!-- 投稿者のユーザーIDを表示 -->
            </td>
        </tr>
        </table>

        <p><?php echo $post['tweet']; ?></p>                                <!-- 投稿内容を表示 -->
            <small>
                <?php echo $post['day']; ?>
                <?php echo $post['time']; ?>
           </small>
    </div>

<?php } ?>
    
    
    <footer>
            <table>
            <tr>
	    <td><button onclick="location.href='http://localhost/plof.php'">プロフィール</button></td>
            <td><button onclick="location.href='http://localhost/tweet.php'">投稿する</button></td>
            <button onclick="location.href='http://localhost/main.php'">更新</button>
            </tr>
         </table>
    </footer>

</body>

</html>