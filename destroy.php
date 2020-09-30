<?php

require './const.php';
session_start();

// ログインユーザーの投稿のうち、created_atに投稿されたものを検索し削除
$pdo = new PDO(DSN, DB_USER, DB_PASS);

$sql = "DELETE FROM fighter_power WHERE created_at = :created_at AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':created_at' => $_POST['created_at'] , ':user_id' => getAuthId()]);

header('Location: ./graph.php');