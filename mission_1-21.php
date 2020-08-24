<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-21</title>
</head>
<body>
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="number" name="num" placeholder="数字を入力してください"><!--type=""text"は1行のテキストボックス作成 名前はstr,placeholderは初期表示する内容-->
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
            $num = $_POST["num"];//$_POST変数に入力フォームのデータが入る
            if($num % 3 == 0 && $num % 5 == 0){
                echo "FizzBuzz<br>";
            }elseif($num % 3 == 0){
                echo "Fizz<br>";
            }elseif($num % 5 == 0){
                echo "Buzz<br>";
            }else{
                echo $num . "<br>";
            }
           
    ?>
</body>
</html>