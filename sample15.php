<?php
ini_set('display_errors', "On");

try {
    $db = new PDO('mysql:dbname=mydb;host=localhost;port=8889;charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception

    // POST request: Process the form to update the data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // First, check if the ID exists in the database
        $checkSql = "SELECT * FROM items WHERE id = :id";
        $checkStmt = $db->prepare($checkSql);
        $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkStmt->execute();
        $existingRecord = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRecord) {
            // Proceed with the update if record exists
            $sql = "UPDATE items SET name = :name WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Check how many rows were affected
            $affected_rows = $stmt->rowCount();
            if ($affected_rows > 0) {
                echo '情報を更新しました。'; // Successfully updated
            } else {
                echo '更新する情報がありませんでした。'; // No changes made
            }
        } else {
            // Record with the given ID doesn't exist
            echo '情報を更新に失敗しました。'; // Record not found
        }
    }

    // Display the existing data for the given ID
    $stmt = $db->query('SELECT * FROM items');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the records in a table format
    if ($records) {
        echo "<h2>データベースの項目一覧:</h2>";
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
        echo "データベースに項目が見つかりませんでした。";
    }

} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データの編集</title>
</head>
<body>

<h2>データを編集する</h2>
<form method="post" action="">
    <label for="id">ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <label for="name">新しい名前:</label>
    <input type="text" id="name" name="name" required><br><br>
    <input type="submit" value="更新">
</form>

</body>
</html>
