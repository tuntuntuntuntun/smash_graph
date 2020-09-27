<?php

session_start();
// セッションをリセット
$_SESSION = [];
session_destroy();

echo 'ログアウトしました。';