<?php
session_start(); // Start session

if (!isset($_SESSION['username'])) {
    header('Location: kadai3_login_form.php'); // Redirect to login form if not logged in
    exit();
}

// Database connection parameters
$dsn = 'mysql:dbname=mydb;host=localhost;port=8889;charset=utf8';
$username = 'root';
$password = 'root';

try {
    // Create a new PDO connection
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception

    // Query to fetch all items from the table
    $stmt = $db->query('SELECT * FROM items');
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>You are logged in.</p>
<p><a href="kadai3_logout.php">Logout</a></p>

<!-- Display the items from the database -->
<h2>Database Items</h2>
<?php if ($items): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No items found in the database.</p>
<?php endif; ?>

</body>
</html>
