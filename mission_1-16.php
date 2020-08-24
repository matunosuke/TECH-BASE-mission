<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-16</title>
</head>
<body>
    <?php
    //ブール値がtrueかfalseかは、var_dump関数を使って表示
    var_dump(true);//bool(true)と表示される
    echo "<br>";
    var_dump(false);//bool(false)と表示される
    echo "<br>";

    $num = 4;
    var_dump($num==4);//numが4の時bool(true)と表示される。４じゃなければbool(false)
    echo "<br>";
    var_dump($num!=4);//numが４の時bool(false)と表示される。4じゃなければbool(true)
    ?>
</body>
</html>