<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-1</title>
</head>
<body>
    <!--入力フォームと送信ボタン作成-->
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="text" name="str" value="コメント"><!--type=""text"は1行のテキストボックス 名前はstr,valueは初期入力値-->
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
        $str = $_POST["str"];//$_POST変数に入力フォームのデータが入る
        if($str != null){//もしstrがからじゃないとき以下の動作
            echo $str . "を受け付けました";
        }
    ?>
</body>
</html>