<?php
// データベース接続パラメータ
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // 必要に応じてポート番号を調整してください
$username = 'root'; // MySQLのユーザー名
$password = 'root'; // MySQLのパスワード

try {
    // データベース接続の試行
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 'items' テーブルからデータを取得
    $stmt = $pdo->query('SELECT * FROM items');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 結果を表示
    if ($records) {
        echo "<h2>mydbからのレコード:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Description</th></tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>" . $record['id'] . "</td>";
            echo "<td>" . $record['name'] . "</td>";
            echo "<td>";
            // 'description' キーが存在するか確認してから表示
            echo isset($record['description']) ? $record['description'] : 'N/A';
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "'items' テーブルにレコードが見つかりませんでした。";
    }

} catch (PDOException $e) {
    echo "データベース接続に失敗しました: " . $e->getMessage();
}
?>
