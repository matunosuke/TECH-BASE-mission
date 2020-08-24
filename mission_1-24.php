<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-24</title>
</head>
<body>
    <?php
        $str = "ラーメン " . PHP_EOL;
        $filename="mission_1-24.txt";
        $fp = fopen($filename,"a");//fpはファイルポインタ"a"追記モード"w"書き込みモード"r"読み込みモード
        fwrite($fp,$str);//fpにstrを書き込む
        fclose($fp);//fpを閉じる
        echo "書き込み成功！";
    ?>
</body>
</html>