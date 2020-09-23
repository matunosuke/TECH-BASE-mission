<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>image_upload</title>
</head>
<body>
    
    <?php

        session_start();
        // ログイン済みかどうかの変数チェックを行う
        if (isset($_SESSION["userid"])) {

           // 変数に値がセットされていない場合は不正な処理と判断し、ログイン画面へリダイレクトさせる
           $no_login_url = "https://tb-220361.tech-base.net/mission_6.php";
           header("Location: {$no_login_url}");
           exit;
        } else {
          echo "ログインしています。";
        }
        echo "<br>";
       
        
    ?>
    
    <?php
    
    //DB接続設定 画像名保存用テーブル作成
    $dsn = "mysql:host=localhost; dbname=データベース名; host=localhost; charset=utf8";
    $username = "ユーザー名";
    $password = "パスワード";
    try {
        $dbh = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $sql = "CREATE TABLE IF NOT EXISTS images"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name varchar(255)"
	.");";
	$stmt = $dbh->query($sql);
    
    //var_dump($_FILES['image']);
    echo "<br>";
    //var_dump(strrchr($_FILES['image']['name'], '.'));
    
    
    //ファイル名をDBに、ファイル名と画像をディレクトリに保存
    if (isset($_POST['upload'])) {//送信ボタンが押された場合
        $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
        $image2 = strrchr($_FILES['image']['name'], '.');//アップロードされたファイルの拡張子を取得
        $image3 = $image . $image2;  //imageとimage2の結合
        $file = "/public_html/images/$image3";//ファイルのパス
        $sql = "INSERT INTO images(name) VALUES (:name)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $image3, PDO::PARAM_STR);
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image3);//imagesディレクトリにファイル保存
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                $message = '画像をアップロードしました';
                $stmt->execute();
                echo "<br>";
                
                $_SESSION["imagename"] = $image3;
                //var_dump($_SESSION["imagename"]);
                
            } else {
                $message = '画像ファイルではありません';
            }
        }
    }
?>
    
    
    
    
    <h1>画像アップロード</h1>
    <!--送信ボタンが押された場合-->
    <?php if (isset($_POST['upload'])): ?>
    <p><?php echo $message; ?></p>
    <?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <p>アップロード画像</p>
        <input type="file" name="image">
        <button><input type="submit" name="upload" value="送信"></button>
    </form>
    <?php endif;?>
    <a href='https://tb-220361.tech-base.net//image.php'>アップロードした画像を見る場合はこちら。</a>
    <br><br><br>
     <a href='https://tb-220361.tech-base.net//logout.php'>ログアウトはこちら。</a>
</body>
</html>