<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Directory to save the uploaded files
        $uploadDir = 'uploads/';

        // Temporary directory for safety copies
        $tempDir = '/Applications/MAMP/tmp/php/';

        // Ensure the directories exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Handle photo upload
        $photo = $_FILES['photo'];
        $photoName = basename($photo['name']);
        $photoTmpName = $photo['tmp_name'];
        $photoDestination = $uploadDir . $photoName;
        $photoTempDestination = $tempDir . $photoName;

        $photoSuccess = false;
        if ($photo['error'] === 0) {
            // Copy to temp directory
            if (copy($photoTmpName, $photoTempDestination)) {
                // Move to final destination
                if (move_uploaded_file($photoTmpName, $photoDestination)) {
                    $photoSuccess = true;
                }
            }
        }

        // Handle file upload
        $file = $_FILES['file'];
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileDestination = $uploadDir . $fileName;
        $fileTempDestination = $tempDir . $fileName;

        $fileSuccess = false;
        if ($file['error'] === 0) {
            // Copy to temp directory
            if (copy($fileTmpName, $fileTempDestination)) {
                // Move to final destination
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $fileSuccess = true;
                }
            }
        }

        // Redirect back to the form with the results
        $query = [];
        if ($photoSuccess) {
            $query['photo'] = $photoDestination;
            $query['photo_name'] = $photoName;
            $query['photo_type'] = $photo['type'];
            $query['photo_size'] = $photo['size'];
            $query['photo_dir'] = $photoDestination;
        }
        if ($fileSuccess) {
            $query['file'] = $fileDestination;
            $query['file_name'] = $fileName;
            $query['file_type'] = $file['type'];
            $query['file_size'] = $file['size'];
            $query['file_dir'] = $fileDestination;
        }
        $queryString = http_build_query($query);
        header("Location: upload_form.html?$queryString");
        exit;
    }
?>
