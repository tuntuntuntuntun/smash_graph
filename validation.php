<?php

// バリデーション関連の関数を定義


// メールアドレスの形式チェック
function validate_mail($val)
{
    $check = 0;

    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = '不正な形式のメールアドレスです。';
        $check++;
    }

    // 空欄ではないかチェック
    if ($val === null) {
        $errors['blank'] = 'メールアドレスを入力してください。';
        $check++;
    }

    if ($check) {
        return true;
    } else {
        return false;
    }
}

// パスワードのチェック
function validate_pass($val)
{
    $check = 0;

    // 文字数チェック
    if (!($val >= 8 && $val <= 16)) {
        $errors['pass_count'] = 'パスワードは8文字以上16文字以下で入力してください。';
        $check++;
    }

    // 使用可能な文字かチェック
    if (!(preg_match("/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/", $val))) {
        $errors['pass_expression'] = 'パスワードには半角の大文字、小文字、数字をそれぞれ一種類以上使用してください。';
        $check++;
    }

    // 空欄ではないかチェック
    if ($val === null) {
        $errors['blank'] = 'パスワードを入力してください。';
        $check++;
    }

    if ($check) {
        return true;
    } else {
        return false;
    }
}

// ファイター名のチェック
function validate_fighter($val)
{
    $url = "./fighters.json";
    $json = file_get_contents($url);
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII, JIS, UTF-8, EUC-JP, SJIS-WIN');
    
    // 配列にする
    $array = json_decode($json, true);

    $check = 0;
    $count = 0;
    for($i = 0; $i < count($array["fighters"]); $i++) {
        if (strcmp($val, $array["fighters"][$i]) === 0) {
            $count++;
            break;
        }
    }
    // 一つも当てはまらなかった場合エラー
    if ($count === 0) {
        $errors['fighters'] = '正しいファイター名を入力してください。';
        $check++;
    }

    // 空欄ではないかチェック
    if ($val === null) {
        $errors['blank'] = 'ファイターを入力してください。';
        $check++;
    }

    if ($check) {
        return true;
    } else {
        return false;
    }
}

// 世界戦闘力のチェック
// 数字であるかチェック
function validate_power($val)
{
    $check = 0;

    if (!(is_numeric($val))) {
        $errors['power'] = '数字を入力してください';
        $check++;
    }

    // 空欄ではないかチェック
    if ($val === null) {
        $errors['blank'] = '世界戦闘力を入力してください。';
        $check++;
    }

    if ($check) {
        return true;
    } else {
        return false;
    }
}