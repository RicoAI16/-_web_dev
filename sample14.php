<?php
// Database connection parameters
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // Adjust the port number if necessary
$username = 'root'; // MySQL username
$password = 'root'; // MySQL password

try {
    // Attempt to connect to the database
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Insert a new record into the 'items' table
        $sql = "INSERT INTO items (id, name) VALUES (:id, :name)";
        $stmt = $pdo->prepare($sql);

        // Get data from form submission
        $newItem = [
            'id' => $_POST['id'], // ID from form input
            'name' => $_POST['name'] // Name from form input
        ];

        $stmt->execute($newItem);
        echo "New record inserted successfully.<br>";
    }

    // Retrieve and display data from the 'items' table
    $stmt = $pdo->query('SELECT * FROM items');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the results
    if ($records) {
        echo "<h2>Records from mydb:</h2>";
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
        echo "No records found in the 'items' table.";
    }

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert New Item</title>
</head>
<body>

<h2>Insert New Item</h2>
<form method="post" action="">
    <label for="id">ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <input type="submit" value="Insert">
</form>

</body>
</html>
