<?php

function isAuth()
{
    // ログインしていなかったらログインページへ遷移
    if (!isset($_SESSION['id'])) {
        header('Location: auth/signin.php');
    }
}