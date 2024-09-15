<?php
// Database connection parameters
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // Adjust the port number if necessary
$db_username = 'root'; // MySQL username
$db_password = 'root'; // MySQL password

try {
    // Attempt to connect to the database
    $pdo = new PDO($dsn, $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the submitted username and password
        $submittedUsername = $_POST['username'];
        $submittedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Insert the new user into the User table
        $stmt = $pdo->prepare('INSERT INTO User (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $submittedUsername, 'password' => $submittedPassword]);

        echo "User inserted successfully. <a href='insert_user.php'>Insert another user</a>";
    }
} catch (PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert User</title>
</head>
<body>

<h2>Insert New User</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Insert User">
</form>

</body>
</html>
