<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="Web開発開発第５回目"/>
</head>
<body>
    <?php
        $week = ['日', '月', '火', '水', '木', '金', '土'];
        // 現在の曜日を取得
        $today = date('w');
        // 今日は、木曜日です　という表示します。
        echo "今日は、" . $week[$today] . "曜日です";
    ?>
</body>
</html>