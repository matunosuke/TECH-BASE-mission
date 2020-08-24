<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-26</title>
</head>
<body>
    <?php
        $str = "Hello World" . PHP_EOL;//strにHello Worldそして改行を代入
        $filename="mission_1-24.txt";
        $fp = fopen($filename,"a");
        fwrite($fp,$str);
        fclose($fp);
        echo "書き込み成功！<br>";
        
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);//linesにfilenameの中身全体を配列として組み込む。FILE_IGNORE_NEW_LINESはファイル内最終行は無視という意味
            foreach($lines as $line){//lines内の配列をfileに代入
                echo $line ."<br>";
            }
        }
    ?>
</body>
</html>