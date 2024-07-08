<?php
// Database connection parameters
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb'; // Adjust port and dbname as needed
$username = 'root'; // MySQL username
$password = 'root'; // MySQL password

session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Database connection
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve user from database based on username
        $stmt = $pdo->prepare('SELECT * FROM User WHERE username = :username');
        $stmt->execute(['username' => $_POST['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($_POST['password'], $user['password'])) {
            // Successful login, set session variables
            $_SESSION['username'] = $user['username'];
            header('Location: kadai3_dashboard.php'); // Redirect to dashboard
            exit();
        } else {
            // Invalid credentials
            echo "Invalid username or password.";
        }

    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>
