<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-9</title>
</head>
<body>

    <?php
     
	//4-2以降でも毎回接続は必要。
	//$dsnの式の中にスペースを入れないこと！

	// 【サンプル】
	// ・データベース名：
	// ・ユーザー名：
	// ・パスワード：
	// の学生の場合：

	// DB接続設定
	echo "開始<br>";
	$dsn = 'mysql:dbname=データベース名;host=localhost';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	// 【！この SQLは tbtest テーブルを削除します！】
	$sql = 'DROP TABLE mission5_1_3_1';
	$stmt = $pdo->query($sql);
	echo "終了<br>";	
	
    ?>        
</body>
</html>