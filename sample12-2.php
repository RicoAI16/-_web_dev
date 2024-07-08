<?php
    // セッションを開始する
    session_start();

    // セッション変数が設定されているかチェックする
    if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];

        echo "ユーザー名: $username <br>";
        echo "メールアドレス: $email <br>";
    } else {
        echo "セッション変数が設定されていません。";
    }
?>
