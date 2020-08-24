<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-8</title>
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
	//4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
	$id = 2;
	$sql = 'delete from tbtest where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
    


	//続けて、4-6の SELECTで表示させる機能 も記述し、表示もさせる。
	//※ データベース接続は上記で行っている状態なので、その部分は不要


	//入力したデータレコードを抽出し，表示する
	//$rowの添字（[ ]内）は、4-2で作成したカラムの名称に併せる必要があります。
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}

	?>        
</body>
</html>