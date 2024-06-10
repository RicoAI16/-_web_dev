<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="データを表示する" content="web開発7回目" />
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
