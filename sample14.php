<?php
// データベース接続パラメータ
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // 必要に応じてポート番号を調整してください
$username = 'root'; // MySQLのユーザー名
$password = 'root'; // MySQLのパスワード

try {
    // データベース接続の試行
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTリクエストがある場合のみ処理を実行
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // 'items' テーブルに新しいレコードを挿入
        $sql = "INSERT INTO items (id, name) VALUES (:id, :name)";
        $stmt = $pdo->prepare($sql);

        // フォームから送信されたデータを取得
        $newItem = [
            'id' => $_POST['id'], // フォームからのID入力
            'name' => $_POST['name'] // フォームからの名前入力
        ];

        $stmt->execute($newItem);
        echo "新しいデータが正常に挿入されました。<br>";
    }

    // 'items' テーブルからデータを取得して表示
    $stmt = $pdo->query('SELECT * FROM items');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 結果を表示
    if ($records) {
        echo "<h2>mydbからのレコード:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th></tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($record['id']) . "</td>";
            echo "<td>" . htmlspecialchars($record['name']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "'items' テーブルにレコードが見つかりませんでした。";
    }

} catch (PDOException $e) {
    // データベース接続に失敗した場合のエラーメッセージを表示
    echo "データベース接続に失敗しました: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新しいアイテムを挿入</title>
</head>
<body>

<h2>新しいアイテムを挿入</h2>
<form method="post" action="">
    <label for="id">ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required><br><br>
    <input type="submit" value="挿入">
</form>

</body>
</html>
