<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
   
      
    <!--入力フォームと送信ボタンなど作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->    
        <!---入力フォームと送信-->
        入力フォーム<br>
        <input type="text" name="name" placeholder="名前を入力してください" ><br><!--type=""text"は1行のテキストボックス 名前はstr-->
        <input type="text" name="comment" placeholder="コメントを入力してください" >
        <input type="submit" name="submit"><br>
        
        
        
        <!---削除フォームと削除ボタン-->
        削除フォーム<br>
        <input type="num" name="del_num" placeholder="削除したい投稿番号を入力してください">
        <button type ="submit" name = "delete">削除</button><br>
        
        
    </form>   
      
    <?php
    $date = date("Y/m/d H:i:s");//年月日時分秒
    $filename = "mission_3-3.txt";
       //元のファイル表示
        echo "元のファイル内容<br>";
        if(file_exists($filename)){//もしファイルが存在するなら
          $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
          foreach($lines as $line){//lines内の配列をfileに代入
            $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
            echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
          }
            echo "<br><br>";
        }

        if(isset($_POST['submit'])){
             //追記する場合
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                //ファイルに内容を追記
                if($name != null && $comment != null){//もしnameとcommentが空じゃないとき以下の動作
                    $fp = fopen($filename,"a");//追記モードでファイルを開く
                    $num = count(file($filename)) + 1;
                    $str = $num ."<>" . $name ."<>" . $comment . "<>" .$date;
                    fwrite($fp,$str. PHP_EOL);//fpにstrを書き込み改行する
                    fclose($fp);
             
             
                   //追記後のファイル内容表示
                   echo "追記後のファイル内容<br>";
                   if(file_exists($filename)){//もしファイルが存在するなら
                      $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                      foreach($lines as $line){//lines内の配列をfileに代入
                           $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                           echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                      }  
                    }  
                }elseif($name == null & $comment != null){
                     echo "名前もしくはコメントを入力してください";
                }
            
            }elseif(isset($_POST['delete'])) {
                $del_num = $_POST['del_num'];
                if($del_num != null ){
                   //投稿内容削除
                   if(file_exists($filename)){//もしファイルが存在するなら
                     $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                     $fp = fopen($filename, "w");
                     foreach($lines as $line){//lines内の配列をfileに代入
                        $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                        if($e_line[0] < $del_num  && $e_line[0] != $del_num){
                          $txt1 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3];
                          fwrite($fp,$txt1. PHP_EOL);
                      
                   }elseif($e_line[0] > $del_num && $e_line[0] != $del_num){
                      $e_line[0] = $e_line[0] - 1;
                      $txt2 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3];
                      fwrite($fp,$txt2. PHP_EOL);
                   }
       
                }
            fclose($fp);
            //削除後のファイル表示
            echo "削除後のファイル内容<br>";
            if(file_exists($filename)){//もしファイルが存在するなら
                   $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                   foreach($lines as $line){//lines内の配列をfileに代入
                      $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                      echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                    }
                }    
                
            }
            }elseif($del_num == null){
                echo "削除番号を入力してください";
            }
         }    
            
             
    
    ?>

</body>
</html>