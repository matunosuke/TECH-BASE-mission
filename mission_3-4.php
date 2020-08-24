<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4</title>
</head>
<body>
   
       <?php
        $date = date("Y/m/d H:i:s");//年月日時分秒
        $filename="mission_3-4.txt";//ファイルの名前
      //編集番号を取得し，指定された投稿番号の名前とコメントを取得
     if(isset($_POST['edit'])){
              $edi_num = $_POST['edi_num'];//編集番号を取得
              
              //もし編集番号が空でなかったら以下を実行
              if($edi_num != null){
                if(file_exists($filename)){//もしファイルが存在するなら
                  $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                  foreach($lines as $line){//lines内の配列をfileに代入
                     $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                     if($e_line[0] == $edi_num){//もし編集したい番号と配列の番号が一致したなら以下を実行
                         $edi_name = $e_line[1];//編集したい名前をedi_nameに代入
                         $edi_comments = $e_line[2];//編集したいコメントをedi_commetsに代入
                         
                         
                     }
                      
                  }
                }  
             }
          
     }

    ?> 
    <!--入力フォームと送信ボタンなど作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->    
        <!---入力フォームと送信-->
        入力フォーム<?php if($edi_num){echo "（編集モード）";}  ?><br>
        <input type="hidden" name="edit_post" value="<?php echo $edi_num; ?>">
        <input type="text" name="name" placeholder="名前を入力してください" value="<?php echo $edi_name; ?>"><br><!--type=""text"は1行のテキストボックス 名前はstr-->
        <input type="text" name="comment" placeholder="コメントを入力してください"  value="<?php echo $edi_comments; ?>">
        <input type="submit" name="submit"><br>
        
        
        
        <!---削除フォームと削除ボタン-->
        削除フォーム<br>
        <input type="num" name="del_num" placeholder="削除したい投稿番号を入力してください">
        <button type ="submit" name = "delete">削除</button><br>
        
        <!---編集フォームと編集ボタン-->
        編集番号入力フォーム<br>
        <input type="num" name="edi_num" placeholder="編集したい投稿番号を入力してください">
        <button type="submit" name="edit">編集</button><br>
        <!--type="submit"は送信ボタン作成、名前はsubmit-->
        
        
    </form>   
      
    <?php
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
    ?>
    <?php

        if(isset($_POST['submit'])){
            $after_edi_name = $_POST['name'];
            $after_edi_comment = $_POST['comment'];
            $after_edi_num = $_POST['edit_post'];
            
            //もし編集番号が空でなかったら以下を実行
            if($after_edi_num){
                if(file_exists($filename)){//もしファイルが存在するなら
                   $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                   $fp = fopen($filename, "w");//書き込みモードでファイル開く、ポインタは1番最初
                   foreach($lines as $line){//lines内の配列をfileに代入
                       $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割し、e_lineに代入
                       if($e_line[0] != $after_edi_num){
                          $txt3 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3];
                          fwrite($fp,$txt3);
    
                         
                       }elseif($e_line[0] == $after_edi_num){
                          $e_line[1] =$after_edi_name;
                          $e_line[2] =$after_edi_comment;
                          $txt4 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3];
                          fwrite($fp,$txt4);
                        }
                      
                    }
                    fclose($fp);
                }  
                
                
                  //編集後のファイル内容表示
                   echo "編集後のファイル内容<br>";
                   if(file_exists($filename)){//もしファイルが存在するなら
                      $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
                      foreach($lines as $line){//lines内の配列をfileに代入
                           $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                           echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                      }  
                    }  
            }elseif($after_edi_num == null){
            
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
                       fwrite($fp,$txt1);
                      
                   }elseif($e_line[0] > $del_num && $e_line[0] != $del_num){
                      $e_line[0] = $e_line[0] - 1;
                      $txt2 = $e_line[0] . "<>" . $e_line[1] . "<>" . $e_line[2] . "<>" . $e_line[3];
                      fwrite($fp,$txt2);
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