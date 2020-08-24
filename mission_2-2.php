<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
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
            $filename="mission_2-2.txt";
            $fp = fopen($filename,"w");
            fwrite($fp,$str);
            fclose($fp);
            if(file_exists($filename)){
               $lines = file($filename);//linesにfilenameの中身全体を配列として組み込む。FILE_IGNORE_NEW_LINESはファイル内最終行は無視という意味
               foreach($lines as $line){//lines内の配列をfileに代入
                if($line =="完成！"){
                    echo "完成おめでとうございます！<br>";
                }else{
                    echo $line ."<br>";
                }
                
                }
            }
        }
    ?>
</body>
</html>