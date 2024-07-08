<?php
    // File name: sample16.php

    // Loop through numbers from 1 to 100
    for ($i = 1; $i <= 100; $i++) {
        // Check conditions in the specified order
        if ($i % 3 == 0 && $i % 5 == 0) {
            echo "FizzBuzz<br>";
        } else if ($i % 3 == 0) {
            echo "Fizz<br>";
        } else if ($i % 5 == 0) {
            echo "Buzz<br>";
        } else {
            echo $i . "<br>";
        }
    }
?>
