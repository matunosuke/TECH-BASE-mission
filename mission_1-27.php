<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="number" name="num" placeholder="数字を入力してください"><!--type=""text"は1行のテキストボックス作成 名前はstr,placeholderは初期表示する内容-->
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
        $num = $_POST["num"] . PHP_EOL;//$_POST変数に入力フォームのデータが入る
        if($num !=null){
        $filename="mission_1-27.txt";
        $fp = fopen($filename,"a");
        fwrite($fp,$num);
        fclose($fp);
        echo "書き込み成功！<br>";
        
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);//linesにfilenameの中身全体を配列として組み込む。FILE_IGNORE_NEW_LINESはファイル内最終行は無視という意味
            foreach($lines as $line){//lines内の配列をfileに代入
                        if($line % 3 == 0 && $line % 5 == 0){
                echo "FizzBuzz<br>";
            }elseif($line % 3 == 0){
                echo "Fizz<br>";
            }elseif($line % 5 == 0){
                echo "Buzz<br>";
            }else{
                echo $line . "<br>";
            }
            }
        }
        }
    ?>
</body>
</html>