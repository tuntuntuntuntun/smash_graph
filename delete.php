<?php

require './const.php';

session_start();

// 特定のファイターのcreated_atを過去５件分取得する
$pdo = new PDO(DSN, DB_USER, DB_PASS);

$sql = "SELECT * FROM fighter_power WHERE fighter = :fighter AND user_id = :user_id LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute([':fighter' => $_POST['fighter'], ':user_id' => getAuthId()]);
$fighter_power = $stmt->fetchAll();

$created_at = [];
foreach ($fighter_power as $fp) {
    array_push($created_at, $fp['created_at']);
}

if ($created_at.length) {
    header('Location: ./mainForm.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="destroy.php" method="post">
        <div>
            <!-- created_atの一覧を表示してそこから選べるようにする -->
            <?php foreach($created_at as $ca): ?>
            <label for="<?= $ca; ?>"><?= $ca; ?></label>
            <input type="radio" name="created_at" id="<?= $ca; ?>" value="<?= $ca; ?>">
            <?php endforeach; ?>
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>
</html>