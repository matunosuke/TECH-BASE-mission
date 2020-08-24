<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-19</title>
</head>
<body>
    <?php
    //繰り返しの時はfor文を用いる
     echo "0";
     echo "<br>";
      for ($i = 1 ; $i <= 99 ; $i++ ) {//０,1,...,99まで繰り返す
         if($i%3==0 && $i%5==0){//3で割った時のあまりが０かつ５で割った時のあまりが０のとき
            echo "FizzBuzz<br>";//FizzBuzzと表示
        }elseif($i%3==0){//3で割った時のあまりが０の時
            echo "Fizz<br>";
        }elseif($i%5==0){//５で割った時のあまりが０の時
            echo "Buzz<br>";
        }else{
        echo $i."<br>";
        }
      }
      
    ?>
</body>
</html>