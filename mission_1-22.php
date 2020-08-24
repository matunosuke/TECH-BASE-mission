<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-22</title>
</head>
<body>
    <?php
         $items = array("キャベツ","レタス","ハクサイ","ホウレンソウ","コマツナ");
    echo $items[0] . "<br>";//arry（）内の１番目表示
    echo $items[1] . "<br>";//arry（）内の２番目表示
    echo $items[2] . "<br>";//arry（）内の３番目表示
    echo $items[3] . "<br>";//arry（）内の４番目表示
    echo $items[4] . "<br>";//arry（）内の５番目表示
    ?>
</body>
</html>




    if($num%3==0 && $num%5==0){//もしnum/3が０かつnum/5が０の場合
        echo "FizzBuzz<br>";
    }elseif ($num%3==0){//もしnum÷3のあまりが０の場合
        echo "Fizz<br>";
    }elseif($num%5==0){//もしnum÷5のあまりが０の場合
        echo "Buzz<br>";
    }else{
        echo $num . "<br>";
    }