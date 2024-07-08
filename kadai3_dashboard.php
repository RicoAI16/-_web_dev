<?php
session_start(); // Start session

if (!isset($_SESSION['username'])) {
    header('Location: kadai3_login_form.php'); // Redirect to login form if not logged in
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
<p><a href="logout.php">Logout</a></p>

</body>
</html>
