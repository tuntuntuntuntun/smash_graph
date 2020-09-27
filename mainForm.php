<?php

require 'auth/isAuth.php';

session_start();

isAuth();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmashGraph</title>
</head>
<body>
    <form action="input.php" method="post">
        <div>
            <label>ファイター名:</label>
            <input type="text" name="fighter">
        </div>
        <div>
            <label>世界戦闘力:</label>
            <input type="mail" name="power">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>
</html>