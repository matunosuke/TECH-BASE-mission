<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
   【この掲示板のテーマ】<br>
    好きな食べ物を一つ書いてください！<br><br>
    <?php
    //データベース接続設定

    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



	//echo "テーブル作成開始<br>";	
    //データベース内にテーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS mission5_1_3_1"
    ." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "date TEXT,"
	. "pass TEXT"
	.");";
	$stmt = $pdo->query($sql);
	//echo "完了<br><br><br>";

      //編集
     if(isset($_POST['edit'])){
              $edi_num = $_POST['edi_num'];//編集番号を取得
              $f_password = $_POST['pass_3'];
              //もし編集番号が空でなく、パスワードがあっていたら以下を実行
              if($edi_num != null && $f_password == "pass"){
                	$sql = 'SELECT * FROM mission5_1_3_1';
                   	$stmt = $pdo->query($sql);
                	$results = $stmt->fetchAll();
                		foreach ($results as $row){
                		     if($row['id'] == $edi_num && $row['pass'] == $f_password){
                             $edi_name = $row['name'];
                             $edi_comments = $row['comment'];
                         
                              }
                        }
                }  
      }

    ?> 
    
    
    
    
    
    
    <!--入力フォーム-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->

        【投稿フォーム】<?php if($edi_num){echo "（編集モード）";}   ?><br>
        <input type="hidden" name="edit_post" value="<?php echo $edi_num; ?>">
        名前：　　　　　<input type="text" name="name" placeholder="名前を入力してください" value="<?php echo $edi_name; ?>"><br><!--type=""text"は1行のテキストボックス 名前はstr-->
        コメント：　　　<input type="text" name="comment" placeholder="コメントを入力してください"  value="<?php echo $edi_comments; ?>"><br>
        パスワード：　　<input type="password" name="pass_1" placeholder="パスワード"><br>
        <input type="submit" name="submit"><br><br>
    
   
        【削除フォーム】<br>
       投稿番号：　　　<input type="num" name="del_num" placeholder="削除したい投稿番号を入力してください"><br>
       パスワード：　　<input type="password" name="pass_2" placeholder="パスワード"><br>
        <button type ="submit" name = "delete">削除</button><br><br>
 
 
        【編集番号入力フォーム】<br>
       投稿番号：　　　 <input type="num" name="edi_num" placeholder="編集したい投稿番号を入力してください"><br>
       パスワード：　　 <input type="password" name="pass_3" placeholder="パスワード"><br>
        <button type="submit" name="edit">編集</button><br><br>
        <!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
    $f_date = date("Y/m/d H:i:s");//年月日時分秒
	
    //入力したデータレコードを抽出し，表示する
	//$rowの添字（[ ]内）は、カラムの名称に併せる必要がある
    //	echo "データレコードを抽出し，表示開始<br>";	
	$sql = 'SELECT * FROM mission5_1_3_1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	echo "--------------------<br>";
    echo "【もとの投稿一覧】<br>";
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['date'].'<br>';		
     	
	}
	echo "--------------------<br>";
	//echo "完了<br><br><br>";
    
    
    
    //フォームに入力された内容を受信、年月日時分秒設定
    $f_date = date("Y/m/d H:i:s");//年月日時分秒
    if(isset($_POST['edit'])){
            if($edi_num == null){
                         echo "<--------------------->";
                         echo "<br>";
                         echo "編集したい番号を入力してください";
                         echo "<br>";
                         echo "<--------------------->";
             }elseif($f_password == null){
                         echo "<--------------------->";
                         echo "<br>";
                         echo "パスワードを入力してください";
                         echo "<br>";
                         echo "<--------------------->";   
             }elseif($f_password != "pass"){
                         echo "<--------------------->";
                         echo "<br>";
                         echo "パスワードが違います";
                         echo "<br>";
                         echo "<--------------------->";   
             }
          
        }
    
    
    if(isset($_POST['submit'])){   
       $after_edi_name = $_POST['name'];
       $after_edi_comment = $_POST['comment'];
       $after_edi_num = $_POST['edit_post'];
       $f_name = $_POST["name"];//$_POST変数に入力フォームのデータが入る
       $f_comment = $_POST["comment"];
       $f_password =  $_POST['pass_1'];
       
       //もし編集番号が空でなかったら以下を実行
       if($after_edi_num != null){
        //bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある。
     	$id = $after_edi_num; //変更する投稿番号
    	$name = $after_edi_name;
    	$comment = $after_edi_comment; //変更したい名前、変更したいコメントは自分で決めること
    	$date = date("Y/m/d H:i:s");//年月日時分秒
    	$sql = 'UPDATE mission5_1_3_1 SET name=:name,comment=:comment,date=:date WHERE id=:id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
    	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    	$stmt->bindParam(':date', $date, PDO::PARAM_STR);
    	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    	$stmt->execute();
    	
    	
	    //入力したデータレコードを抽出し，表示する
        //$rowの添字（[ ]内）は、カラムの名称に併せる必要がある
        //echo "データレコードを抽出し，表示開始<br>";	
        $sql = 'SELECT * FROM mission5_1_3_1';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        echo "--------------------<br>";
        echo "【編集後の投稿一覧】<br>";
        foreach ($results as $row){
     	   	//$rowの中にはテーブルのカラム名が入る
    	   	echo $row['id'].',';
     	   	echo $row['name'].',';
     	   	echo $row['comment'].',';
     	   	echo $row['date'].'<br>';		
        
        }
        echo "--------------------<br>";
    	
    	
    	
    	
    	
    	
        //テーブルに内容を追記
       }elseif($after_edi_num == null && $f_name != null && $f_comment != null && $f_password == "pass"){//もしnameとcommentが空じゃないとき以下の動作
           // echo "データ入力開始<br>";
        	$sql = $pdo -> prepare("INSERT INTO mission5_1_3_1 (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
	        $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
	        $name = $f_name;
	        $comment = $f_comment; //好きな名前、好きな言葉は自分で決めること
	        $date = $f_date;
	        $pass = $f_password;
	        $sql -> execute();
	        //  echo "完了<br><br><br>";
	        
	        
	        //入力したデータレコードを抽出し，表示する
         	//$rowの添字（[ ]内）は、カラムの名称に併せる必要がある
         	//echo "データレコードを抽出し，表示開始<br>";	
        	$sql = 'SELECT * FROM mission5_1_3_1';
        	$stmt = $pdo->query($sql);
        	$results = $stmt->fetchAll();
            echo "--------------------<br>";
            echo "【追記後の投稿一覧】<br>";
        	foreach ($results as $row){
     	    	//$rowの中にはテーブルのカラム名が入る
    	     	echo $row['id'].',';
     	    	echo $row['name'].',';
     	    	echo $row['comment'].',';
     	    	echo $row['date'].'<br>';		
            
        	}
        	echo "--------------------<br>";
	        //echo "完了<br><br><br>";
        }elseif($f_name == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "名前を入力してください";
                    echo "<br>";
                    echo "<--------------------->";
        }elseif($f_comment == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "コメントを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
        }elseif($f_password == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "パスワードを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
        }elseif($f_password != "pass"){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "パスワードが違います";
                    echo "<br>";
                    echo "<--------------------->";
        }
       
    }elseif(isset($_POST['delete'])) {
        $f_password = $_POST['pass_2'];
        $del_num = $_POST["del_num"];
        if($del_num != null && $f_password == "pass"){
        
        $id = $del_num;
     	$sql = 'delete from mission5_1_3_1 where id=:id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    	$stmt->execute();
        //入力したデータレコードを抽出し，表示する
	    //$rowの添字（[ ]内）は、カラムの名称に併せる必要がある
    	//echo "データレコードを抽出し，表示開始<br>";	
    	$sql = 'SELECT * FROM mission5_1_3_1';
    	$stmt = $pdo->query($sql);
     	$results = $stmt->fetchAll();
     	echo "--------------------<br>";
        echo "【削除後の投稿一覧】<br>";
    	foreach ($results as $row){
	    	//$rowの中にはテーブルのカラム名が入る
     		echo $row['id'].',';
    		echo $row['name'].',';
	    	echo $row['comment'].',';
	    	echo $row['date'].'<br>';		
        
    	}
    	echo "--------------------<br>";
	//echo "完了<br><br><br>";
       }elseif($del_num == null){
                echo "<--------------------->";
                echo "<br>";
                echo "削除番号を入力してください";
                echo "<br>";
                echo "<--------------------->";
        }elseif($f_password == null){
                echo "<--------------------->";
                echo "<br>";
                echo "パスワードを入力してください";
                echo "<br>";
                echo "<--------------------->";
        }elseif($f_password != "pass"){
                echo "<--------------------->";
                echo "<br>";
                echo "パスワードが違います";
                echo "<br>";
                echo "<--------------------->";
        }
    
    }

        
    ?>        
</body>
</html>