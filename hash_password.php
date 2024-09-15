<?php
    // Example PHP code to hash passwords

    $password = 'root'; // Replace with the actual password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    echo "Original Password: $password<br>";
    echo "Hashed Password: $hashedPassword<br>";
?>
