<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>
<body>
    <h2>会員登録</h2>
    <form action="register.php" method="post">
        <div>
            <label for="mail">メールアドレス</label>
            <input type="mail" name="mail">
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="新規登録">
        </div>
    </form>
    <div>
        <a href="./signin.php">ログインはこちら</a>
    </div>
</body>
</html>