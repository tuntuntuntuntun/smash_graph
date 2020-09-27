<?php

session_start();

// ログインしていたらmainFormへ遷移
if (isset($_SESSION['id'])) {
    header('Location: ../mainForm.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>
<body>
    <h2>ログイン</h2>
    <form action="./login.php" method="post">
        <div>
            <label for="mail">メールアドレス</label>
            <input type="mail" name="mail">
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
    <div>
        <a href="./signup.php">会員登録はこちら</a>
    </div>
</body>
</html>