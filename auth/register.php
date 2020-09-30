<?php

require '../const.php';
require '../validation.php';

// 不備があった場合入力画面へ
if(validate_mail($_POST['mail'])) {
    header('Location: ./signup.php');
}
if(validate_pass($_POST['password'])) {
    header('Location: ./signup.php');
}

session_start();

$mail = $_POST['mail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);

    $sql = "SELECT * FROM user WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user['mail'] === $mail) {
        $errors['mail'] = 'このメールアドレスはすでに登録されています。';

        header('Location: ./signup.php');
    } else {
        // ユーザー情報を挿入
        $sql = "INSERT INTO user(mail, password) VALUES (:mail, :pass)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':pass', $password);

        $stmt->execute();

        // 登録したユーザーのidを取得
        $sql = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
        $stmt = $pdo->query($sql);
        $id = $stmt->fetch();

        $_SESSION['id'] = $id[0];

        header('Location: ../mainForm.php');
    }
} catch (PDOException $e) {
    exit($e->getMessage());
}