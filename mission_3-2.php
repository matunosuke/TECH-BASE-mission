<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
    <!--入力フォームと送信ボタン作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="text" name="name" placeholder="名前を入力してください"><!--type=""text"は1行のテキストボックス 名前はstr-->
        <input type="text" name="comment" placeholder="コメントを入力してください">
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
    
    
       //フォームに入力された内容を受信、年月日時分秒設定
        $name = $_POST["name"];//$_POST変数に入力フォームのデータが入る
        $comment = $_POST["comment"];
        $date = date("Y/m/d H:i:s");//年月日時分秒
            
        //ファイルに内容を追記
        if($name != null && $comment != null){//もしnameとcommentが空じゃないとき以下の動作
            $filename="mission_3-1.txt";//ファイルの名前
            $fp = fopen($filename,"a");//追記モードでファイルを開く
            $num = count(file($filename)) + 1;
            $str = $num ."<>" . $name ."<>" . $comment . "<>" .$date;
            fwrite($fp,$str. PHP_EOL);//fpにstrを書き込み改行する
            fclose($fp);
            }
            
           
            
            //ブラウザにファイル内のを表示する
            if(file_exists($filename)){//もしファイルが存在するなら
               $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
               foreach($lines as $line){//lines内の配列をfileに代入
                    $e_line = explode("<>",$line);//<>を区切り文字としてlineの文字列を分割
                    echo $e_line[0] . $e_line[1] . $e_line[2] . $e_line[3] . "<br>";//分割された文字列を4要素表示
                }
            }

    ?>        
</body>
</html>