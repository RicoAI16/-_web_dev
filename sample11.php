<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="データを表示する" content="web開発7回目" />
    <title>File Upload Result</title>
</head>
<body>
    <?php
    // Web accessible upload directory
    $webUploadDir = 'uploads/';
    // Backup upload directory
    $backupUploadDir = '/Applications/MAMP/tmp/php/';

    // Create directories if they don't exist
    if (!is_dir($webUploadDir)) {
        mkdir($webUploadDir, 0777, true);
    }
    if (!is_dir($backupUploadDir)) {
        mkdir($backupUploadDir, 0777, true);
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle photo upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photoTmpPath = $_FILES['photo']['tmp_name'];
            $photoName = basename($_FILES['photo']['name']);
            $photoDestPath = $webUploadDir . $photoName;
            $photoBackupPath = $backupUploadDir . $photoName;

            // Move the file to the web-accessible directory
            if (move_uploaded_file($photoTmpPath, $photoDestPath)) {
                // Copy the file to the backup directory
                copy($photoDestPath, $photoBackupPath);
                echo "<p>Photo uploaded successfully: <a href='$photoDestPath'>$photoName</a></p>";
                echo "<img src='$photoDestPath' alt='$photoName' style='max-width:300px;'><br>";
            } else {
                echo "<p>Failed to upload photo.</p>";
            }
        } else {
            echo "<p>No photo uploaded or an error occurred.</p>";
        }

        // Handle file upload
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = basename($_FILES['file']['name']);
            $fileDestPath = $webUploadDir . $fileName;
            $fileBackupPath = $backupUploadDir . $fileName;

            // Move the file to the web-accessible directory
            if (move_uploaded_file($fileTmpPath, $fileDestPath)) {
                // Copy the file to the backup directory
                copy($fileDestPath, $fileBackupPath);
                echo "<p>File uploaded successfully: <a href='$fileDestPath'>$fileName</a></p>";
            } else {
                echo "<p>Failed to upload file.</p>";
            }
        } else {
            echo "<p>No file uploaded or an error occurred.</p>";
        }
    }
    ?>
</body>
</html>
