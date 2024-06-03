<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="title" content="web開発4回目"/>
</head>
<body>
    <?php
    // PHP code to display your name
    $name = "リコ";
    echo "<h1>Hello, 私の名前は $name</h1>";

    $seconds_in_minute = 60;
    $minutes_in_hour = 60;
    $hours_in_day = 24;

    $seconds_in_day = $seconds_in_minute * $minutes_in_hour * $hours_in_day;
    echo "<p>$seconds_in_minute * $minutes_in_hour * $hours_in_day</p>";
    echo "<p>There are $seconds_in_day seconds in a day</p>";
    ?>
</body>
</html>
