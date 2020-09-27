<?php

require 'const.php';

session_start();

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);

    // 最新のレコードのfighterを取得
    $sql = "SELECT fighter FROM fighter_power WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => getAuthId()]);
    $fighter = $stmt->fetch();

    // 連想配列からファイター名を取得
    foreach ($fighter as $record) {
        $fighter = $record;
    }

    // 取得したfighterのレコードからuser_idがログイン中のものをすべて取得する
    $sql = "SELECT * FROM fighter_power WHERE user_id = :user_id AND fighter = :fighter ORDER BY created_at ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => getAuthId(), ':fighter' => $fighter]);

    // レコードを一件ずつ取り出す
    $power = [];
    $created_at = [];
    foreach ($stmt->fetchAll() as $this_fighter) {
        $fighter = $this_fighter['fighter'];
        array_push($power, $this_fighter['power']);
        array_push($created_at, $this_fighter['created_at']);
    }

    
} catch (PDOException $e) {
    exit($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グラフ</title>
</head>
<body>
    <!-- 取得した情報をindex.phpに渡す -->
    <form action="index.php" method="post" name="form">
        <input type="hidden" name="fighter" value="<?= $fighter; ?>">

        <?php foreach ($power as $p_val): ?>
        <input type="hidden" name="power[]" value="<?= $p_val; ?>">
        <?php endforeach; ?>

        <?php foreach ($created_at as $c_val): ?>
        <input type="hidden" name="created_at[]" value="<?= $c_val; ?>">
        <?php endforeach; ?>
    </form>

    <script>
        // submitする
        document.form.submit();
    </script>
</body>
</html>