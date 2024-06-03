<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta title="Web開発第五回目">
</head>
<body>
    <?php
        // 今日の日付をUnixタイムスタンプとして取得する
        $startdate = strtotime('today');

        // 1年後の日付を計算し、Unixタイムスタンプとして取得する
        $enddate = strtotime('+1 year', $startdate);

        for ($date = $startdate; $date <= $enddate; $date = strtotime('+1 day', $date)) 
        {
            // 日付を指定された形式で出力する
            echo date('Y/m/d (D)', $date) . ", <br>";
            ## echo date('Y/n/j (D)', $date) . ", <br>";
        }
    ?>
</body>
</html>