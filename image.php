<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>image</title>
</head>
<body>
    <?php
    session_start();
    
    
    //データベース接続設定
    $dsn = "mysql:host=localhost; dbname=データベース名; host=localhost; charset=utf8";
    $username = "ユーザー名";
    $password = "パスワード";
    //$id = rand(1, 5);
    //var_dump($_SESSION["imagename"]);
    $imagename = $_SESSION["imagename"];
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    
    //アップロードした画像の名前の照合
    $sql = 'SELECT * FROM images';
	$stmt = $dbh->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		//表示する名前とDBの名前が一致したら
		if($row['name'] == $imagename) {
		    $imagename2 = $row['name']; //imagename2に名前を代入
		}
	}
    
    
    /*
    $sql = "SELECT * FROM images WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $image = $stmt->fetch();
    */
    
    /*
    $sql = "SELECT * FROM images WHERE name = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($imagename);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    */
    
    //echo $imagename2;
    //var_dump($row);

?>
 
 
 
<h1>画像表示</h1>
<img src="images/<?php echo $imagename2; ?>" width="300" height="300">
<br><br>
<a href='https://tb-220361.tech-base.net//after_login.php'>もう一度画像をアップロードする。</a>
<br><br>
<a href='https://tb-220361.tech-base.net//logout.php'>ログアウトはこちら。</a>

    
</body>
</html>