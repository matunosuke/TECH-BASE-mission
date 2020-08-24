<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-17</title>
</head>
<body>
    <?php
    $num = 15;
    if($num%3==0 && $num%5==0){//もしnum/3が０かつnum/5が０の場合
        echo "FizzBuzz<br>";
    }elseif ($num%3==0){//もしnum/3が０の場合
        echo "Fizz<br>";
    }elseif($num%5==0){//もしnum/5が０の場合
        echo "Buzz<br>";
    }else{
        echo $num . "<br>";
    }
    ?>
</body>
</html>