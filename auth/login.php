<?php

require '../const.php';

session_start();

$mail = $_POST['mail'];
$password = $_POST['password'];

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);

    // 入力されたメールアドレスと一致するユーザーの情報を取得
    $sql = "SELECT * FROM user WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $user = $stmt->fetch();

    // パスワードがあっていた場合
    if (password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        // 登録したユーザーのidを取得
        $sql = "SELECT id FROM user WHERE id = :id ORDER BY id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $user['id']]);
        $id = $stmt->fetch();

        $_SESSION['id'] = $id[0];
        
        header('Location: ../mainForm.php');
        exit();
    } else {
        header('Location: ./signin.php');
        exit();
    }
} catch (PDOException $e) {
    exit($e->getMessage());
}