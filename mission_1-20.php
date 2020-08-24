<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-20</title>
</head>
<body>
    <form action="" method="post"><!--action属性なし(送信先)、method="post" は本文がそのまま送信-->
        <input type="text" name="str"><!--type=""text"は1行のテキストボックス作成 名前はstr-->
        <input type="submit" name="submit"><!--type="submit"は送信ボタン作成、名前はsubmit-->
    </form>
    <?php
            $str = $_POST["str"];//$_POST変数に入力フォームのデータが入る
            echo $str;
    ?>
</body>
</html>