<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-5</title>
</head>
<body>
    【この掲示板のテーマ】<br>
    好きな食べ物を一つ書いてください！<br><br>
    
       <?php
        $date = date("Y/m/d H:i:s");//年月日時分秒
        $filename="mission_3-5.txt";//ファイルの名前
      //編集
     if(isset($_POST['edit'])){
              $edi_num = $_POST['edi_num'];//編集番号を取得
              $password3 = $_POST['pass_3'];
              //もし編集番号が空でなく、パスワードがあっていたら以下を実行
              if($edi_num != null){
                if(file_exists($filename)){//もしファイルが存在するなら
                  $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                  foreach($lines as $line){//lines内の配列をfileに代入
                     $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                     if($e_line[0] == $edi_num && $e_line[4] == $password3){
                         $edi_name = $e_line[1];
                         $edi_comments = $e_line[2];
                         $edi_password = $e_line[4];
                         
                         
                     }
                      
                  }
                }  
             }
     }

    ?> 
    <!--入力フォームと送信ボタンなど作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <!---入力フォームと送信-->
        【投稿フォーム】<?php if(isset($edi_num)){echo "（編集モード）";}   ?><br>
        <input type="hidden" name="edit_post" value="<?php echo $edi_num; ?>">
        名前：　　　　　<input type="text" name="name" placeholder="名前を入力してください" value="<?php if(isset($edi_name)){echo $edi_name; }?>"><br><!--type=""text"は1行のテキストボックス 名前はstr-->
        コメント：　　　<input type="text" name="comment" placeholder="コメントを入力してください"  value="<?php if(isset($edi_comments)){echo $edi_comments;} ?>"><br>
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
       //元のファイル表示
        echo "--------------------<br>";
        echo "【投稿一覧】<br>";
        if(file_exists($filename)){//もしファイルが存在するなら
          $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
          foreach($lines as $line){//lines内の配列をfileに代入
            $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
            echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
          }
         echo "--------------------<br>"; 
            echo "<br><br>";
        }
    ?>
    <?php
        if(isset($_POST['edit'])){
            if($edi_num == null){
                         echo "<--------------------->";
                         echo "<br>";
                         echo "編集したい番号を入力してください";
                         echo "<br>";
                         echo "<--------------------->";
             }elseif($password3 == null){
                         echo "<--------------------->";
                         echo "<br>";
                         echo "パスワードを入力してください";
                         echo "<br>";
                         echo "<--------------------->";   
             }elseif($password3 != $edi_password){
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
            $password1 = $_POST['pass_1'];
            $name = $_POST['name'];
            $comment = $_POST['comment'];
            
            //もし編集番号が空でなかったら以下を実行
            if($after_edi_num != null){
                if($after_edi_name != null && $after_edi_comment != null && $password1 != null){
                    if(file_exists($filename)){//もしファイルが存在するなら
                      $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                      $fp = fopen($filename, "w");//書き込みモードでファイル開く、ポインタは1番最初
                      foreach($lines as $line){//lines内の配列をfileに代入
                          $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割し、e_lineに代入
                          if($e_line[0] != $after_edi_num){
                             $txt3 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3] . "<>" . $e_line[4]. "<>";
                             fwrite($fp,$txt3. PHP_EOL);
    
                         
                          }elseif($e_line[0] == $after_edi_num){
                             $e_line[1] =$after_edi_name;
                             $e_line[2] =$after_edi_comment;
                             $txt4 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3] . "<>" . $e_line[4]. "<>";
                             fwrite($fp,$txt4. PHP_EOL);
                          }
                      
                      }
                      fclose($fp);
                    }  
                
                
                  //編集後のファイル内容表示
                   echo "--------------------<br>";
                   echo "【編集後の投稿一覧】<br>";
                   if(file_exists($filename)){//もしファイルが存在するなら
                      $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                      foreach($lines as $line){//lines内の配列をfileに代入
                           $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                           echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] ."<br>";//分割された文字列を4要素表示
                      }  
                    }  
                    echo "--------------------<br>";
                }elseif($after_edi_name == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "名前を入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }elseif($after_edi_comment == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "コメントを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }elseif($password1 == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "パスワードを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }
            }elseif($after_edi_num == null){
            
             //追記する場合
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $password1 = $_POST['pass_1'];
                
                //ファイルに内容を追記
                if($name != null && $comment != null && $password1 != null){//もしnameとcommentが空じゃないとき以下の動作
                    $fp = fopen($filename,"a");//追記モードでファイルを開く
                    $num = count(file($filename)) + 1;
                    $str = $num ."<>" . $name ."<>" . $comment . "<>" .$date . "<>" .$password1. "<>";
                    fwrite($fp,$str. PHP_EOL);//fpにstrを書き込み改行する
                    fclose($fp);
             
             
                   //追記後のファイル内容表示
                   echo "--------------------<br>";
                   echo "【追記後の投稿一覧】<br>";
                   if(file_exists($filename)){//もしファイルが存在するなら
                      $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                      foreach($lines as $line){//lines内の配列をfileに代入
                           $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                           echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                      }  
                    } 
                    echo "--------------------<br>";
                }elseif($name == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "名前を入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }elseif($comment == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "コメントを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }elseif($password1 == null){
                    echo "<--------------------->";
                    echo "<br>";
                    echo "パスワードを入力してください";
                    echo "<br>";
                    echo "<--------------------->";
                }
            
            }
    
        
         
               
        }elseif(isset($_POST['delete'])) {
          $del_num = $_POST['del_num'];
          $password2 = $_POST['pass_2'];
          //投稿内容削除
          if($del_num != null){
             if(file_exists($filename)){//もしファイルが存在するなら
                $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                foreach($lines as $line){
                     $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                     if($e_line[0] == $del_num){//もし配列の1番目の数字が削除番号と一致したら始め
                        $del_password = $e_line[4];//配列のパスワードを取り出す
                      }
                }
             }  
          }
          if($password2 == $del_password){
                $fp = fopen($filename, "w");
                foreach($lines as $line){//lines内の配列をfileに代入
                   $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                   if($e_line[0] < $del_num && $e_line[0] != $del_num){
                       $txt1 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3]. "<>" . $e_line[4]. "<>";
                       fwrite($fp,$txt1. PHP_EOL);
                      
                   }elseif($e_line[0] > $del_num && $e_line[0] != $del_num){
                      $e_line[0] = $e_line[0] - 1;
                      $txt2 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3]. "<>" . $e_line[4]. "<>";
                      fwrite($fp,$txt2. PHP_EOL);
                   }
       
                }
                fclose($fp);
                //削除後のファイル表示
                echo "--------------------<br>";
                echo "【削除後の投稿一覧】<br>";
                if(file_exists($filename)){//もしファイルが存在するなら
                     $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                     foreach($lines as $line){//lines内の配列をfileに代入
                        $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                        echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                     }
                }    
                echo "--------------------<br>";    
            }elseif($del_num == null){
                echo "<--------------------->";
                echo "<br>";
                echo "削除番号を入力してください";
                echo "<br>";
                echo "<--------------------->";
            }elseif($password2 == null){
                echo "<--------------------->";
                echo "<br>";
                echo "パスワードを入力してください";
                echo "<br>";
                echo "<--------------------->";
            }elseif($password2 != $del_password){
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
