<?php

// 入力されたデータを挿入

require 'const.php';
require 'validation.php';

// 不備があった場合入力画面へ
if(validate_fighter($_POST['fighter'])) {
    header('Location: ./mainForm.php');
}
if(validate_power($_POST['power'])) {
    header('Location: ./mainForm.php');
}

session_start();

$fighter = $_POST['fighter'];
$power = $_POST['power'];

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);

    // fighter_powerテーブルにレコードを挿入
    $sql = "INSERT INTO fighter_power(user_id, fighter, power, created_at) VALUES (:user_id, :fighter, :power, :created_at)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([':user_id' => getAuthId(), ':fighter' => $fighter, ':power' => $power, ':created_at' => date('Y-m-d H:i:s')]);

} catch (PDOException $e) {
    exit($e->getMessage());
}

header('Location: ./graph.php');