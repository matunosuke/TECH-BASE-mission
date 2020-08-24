<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-4</title>
</head>
<body>
    <!--入力フォームと送信ボタン作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="text" name="str"><!--type=""text"は1行のテキストボックス 名前はstr-->
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
        $str = $_POST["str"];//$_POST変数に入力フォームのデータが入る
        if($str != null){//もしstrが空じゃないとき以下の動作
            $filename="mission_2-4.txt";//ファイルの名前
            $fp = fopen($filename,"a");//追記モードでファイルを開く
            fwrite($fp,$str. PHP_EOL);//fpにstrを書き込み改行する
            fclose($fp);
            if(file_exists($filename)){//もしファイルが存在するなら
               $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む
               foreach($lines as $line){//lines内の配列をfileに代入
                    echo $line ."<br>";
                }
            }
        }
    ?>
</body>
</html>