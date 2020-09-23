<?php
  /*
        function h($s){
          return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
        }
        
        session_start();
        //ログイン済みの場合
        if (isset($_SESSION['userid'])) {
            echo 'ようこそ' .  h($_SESSION['userid']) . "さん<br>";
            echo "<a href='https://tb-220361.tech-base.net//logout.php'>ログアウトはこちら。</a>";
            exit;
        }
      */
 
?>





<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_6</title>
</head>
<body>

    <?php

    
    //データベース接続設定

    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	//echo "テーブル作成開始<br>";	
    //データベース内にテーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS UserData"
    ." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "userid varchar(255),"
	. "pass varchar(255)"
	.");";
	$stmt = $pdo->query($sql);
	//echo "完了<br><br><br>";
	
   ?>
  
  

   
   
   

   <h1>ようこそ、ログインしてください。</h1>
    <!--入力フォーム-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <fieldset>
          【ログインフォーム】<br>
           <input type="hidden" name="edit_post" value="<?php if(isset($edi_num)){echo $edi_num;} ?>">
           ユーザーID：　　<input type="text" name="userid1" value="<?php if(isset($edi_name)){echo $edi_name;} ?>"><br><!--type=""text"は1行のテキストボックス 名前はstr-->
           パスワード：　　<input type="password" name="password1" ><br>
           <button type="submit" name="login">ログインする</button><br><br>
       </fieldset>
    </form>
    
    
    <h1>初めての方はこちら</h1>   
    <form  action="" method="post"><!--action(送信先)、method="post" は本文がそのまま送信-->
        <fieldset>
          【新規登録フォーム】<br>
           
           ユーザーID：　　<input type="text" name="userid2"><br><!--type=""text"は1行のテキストボックス 名前はstr-->
           パスワード：　　<input type="password" name="password2" ><br>
           <button type="submit" name="signup">新規登録する</button><br><br>
           <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
       </fieldset>
    </form>
<?php

   //登録ボタンが押された場合
   if(isset($_POST['signup'])){
       //ユーザーIDの入力チェック
       if(empty($_POST['userid2'])){
           echo "ユーザーIDが未入力です。";
       }elseif(empty($_POST['password2'])){
           echo "パスワードが未入力です。";
       }
   
       //ユーザーIDとパスワードが両方入力された場合
       if(!empty($_POST['userid2']) && !empty($_POST['password2'])){
           //入力されたユーザーIDを格納
           $userid = $_POST['userid2'];
           if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password2'])) { //半角英数字をそれぞれ1文字以上含んだ8文字以上
             $userpassword = password_hash($_POST['password2'], PASSWORD_DEFAULT); //パスワードをハッシュ化
           }else{
                echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
                return false;
           }
       
       
           try{
               $stmt = $pdo->prepare('select * from UserData where userid = ?');
               $stmt->execute([$_POST['userid2']]);
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
           }catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
           } 
         
           //useridがDB内に存在しているか確認
           if ($row['userid'] == null) {
       
            //登録処理       
            try{
               $stmt = $pdo->prepare("insert into UserData(userid, pass) value(?, ?)");
               $stmt ->execute([$userid, $userpassword]);
               echo "登録完了";
            }catch (\Exception $e){
               echo "登録済みのユーザーIDです。";
            }
            
           }elseif($row['userid'] != null){
               echo "登録済みのユーザーIDです。";
           }
       }
  
   }
   if(isset($_POST['login'])){
       //ユーザーIDの入力チェック
       if(empty($_POST['userid1'])){
           echo "ユーザーIDが未入力です。";
       }elseif(empty($_POST['password1'])){
           echo "パスワードが未入力です。";
       }
        //ユーザーIDとパスワードが両方入力された場合
       if($_POST['userid1'] != null && $_POST['password1'] != null){
           try{
               $stmt = $pdo->prepare('select * from UserData where userid = ?');
               $stmt->execute([$_POST['userid1']]);
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
           }catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
           } 
         
           //useridがDB内に存在しているか確認
           if (!isset($row['userid'])) {
              echo 'ユーザーID又はパスワードが間違っています。1';
              return false;
           }
           //パスワード確認後sessionにメールアドレスを渡す
           if (password_verify($_POST['password1'], $row['pass'])) {
              session_regenerate_id(true); //session_idを新しく生成し、置き換える
              $_SESSION['userid'] = $row['userid'];
              echo 'ログインしました';
            } else {
              echo 'ユーザーID又はパスワードが間違っています。2';
              return false;
            }
           
       }
       if($_SESSION['userid'] != null){
           echo "画面移行開始";
           $after_login_url = "https://tb-220361.tech-base.net/after_login.php";
           header("Location: {$after_login_url}");
           exit;
           echo "画面移行失敗";
       }elseif($_SESSION['userid'] == null){
           echo "ログインしてください。";
       }
       
   }
   
   
   
?>
    
        
</body>
</html>