<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-2</title>
</head>
<body>

    <?php
     
	//4-2以降でも毎回接続は必要。
	//$dsnの式の中にスペースを入れないこと！

	// 【サンプル】
	// ・データベース名：
	// ・ユーザー名
	// ・パスワード：
	// の学生の場合：

	// DB接続設定
	echo "開始<br>";
	$dsn = 'mysql:dbname=データベース名;host=localhost';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	
	//4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    //テーブルの作成
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);
	echo "終了<br>";
    ?>        
</body>
</html>