<?php
    // セッションを開始する
    session_start();

    // セッション変数に値を割り当てる
    $_SESSION['username'] = 'Phyo Thiha';
    $_SESSION['email'] = 'phyothihax.6@gmail.com';

    // メッセージを表示する
    echo "セッション変数が設定されました。";
?>
