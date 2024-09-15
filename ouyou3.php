<?php
// XSS Protection: Escape user input before processing it
function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get height and weight from the form and escape the input
    $height = escape($_POST['height']);
    $weight = escape($_POST['weight']);

    // Validate the input (check if they are numeric values)
    if (is_numeric($height) && is_numeric($weight)) {
        // Convert height to float and ensure it's in meters
        $height = (float)$height;
        $weight = (float)$weight;

        // Calculate the ideal weight (理想体重)
        $ideal_weight = $height * $height * 22;

        // Calculate BMI
        $bmi = $weight / ($height * $height);

        // Calculate the difference between the current and ideal weight
        $difference = $weight - $ideal_weight;

        // Display the result
        echo "体重: " . $weight . "kg<br>";
        echo "理想体重: " . number_format($ideal_weight, 2) . "kg<br>";

        if ($difference > 0) {
            echo "あなたは理想体重より " . number_format($difference, 2) . "kg 重いです。<br>";
        } else if ($difference < 0) {
            echo "あなたは理想体重より " . number_format(-$difference, 2) . "kg 軽いです。<br>";
        } else {
            echo "あなたは理想体重です！<br>";
        }

        echo "BMI: " . number_format($bmi, 2) . "<br>";
    } else {
        echo "正しい身長と体重を入力してください。";
    }
} else {
    echo "フォームを使ってください。";
}
?>
