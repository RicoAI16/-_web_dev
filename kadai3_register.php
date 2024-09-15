<?php
// Database connection parameters
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // Adjust port and dbname as needed
$username = 'root'; // MySQL username
$password = 'root'; // MySQL password

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Database connection
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert new user into the database
        $sql = "INSERT INTO User (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);

        // Hash password (optional but recommended)
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt->execute([
            'username' => $_POST['username'],
            'password' => $hashedPassword
        ]);

        echo "User registered successfully.";

        // Redirect to login page after registration
        header('Location: kadai3_login_form.php');
        exit();

    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
