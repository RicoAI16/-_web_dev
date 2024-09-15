<?php
session_start();

// Database connection parameters
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb';
$username = 'root';
$password = 'root';

// Function to hash a password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Connect to database
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve form data
        $submittedUsername = $_POST['username'];
        $submittedPassword = $_POST['password'];

        // Hash the password
        $hashedPassword = hashPassword($submittedPassword);

        // Insert user into database
        $stmt = $pdo->prepare('INSERT INTO User (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $submittedUsername, 'password' => $hashedPassword]);

        echo "User registered successfully.";
    } catch (PDOException $e) {
        echo 'Database connection failed: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>User Registration</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Register">
</form>

</body>
</html>
