<?php
if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];
    $allowed = array('jpg', 'png', 'gif', 'webp');

    foreach ($files['name'] as $position => $fileName) {

        $fileTmp = $files['tmp_name'][$position];
        $fileSize = $files['size'][$position];
        $fileError = $files['error'][$position];

        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));

        if (in_array($fileExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize <= 1000000) {

                    $fileNameNew = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = 'uploads/' . $fileNameNew;

                    if (move_uploaded_file($fileTmp, $fileDestination)) {

                        $uploaded[$position] = $fileDestination;
                    } else {
                        echo "failed to upload your image";
                    }
                } else {
                    echo "Your file is too big";
                }
            } else {
                echo "failed to upload.";
            }
        } else {
            echo "This extension is not allowed.";
        }
    }

    if (!empty($uploaded)) {
        echo "Your file was uploaded";
    }
} else {
    echo 'Please upload a file.';
}
