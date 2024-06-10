<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Display Data</title>
</head>
<body>
    <?php
    if (isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        echo "<p>お名前は: $name</p>";
    } else {
        echo "<p>お名前が入力されていません。</p>";
    }
    ?>
</body>
</html>
