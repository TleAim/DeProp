
<?php

$uploadDir = './upload/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

foreach ($_FILES as $file) {
    if ($file['error'] === 0 && $file['size'] <= 5 * 1024 * 1024) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($extension), $allowedExtensions)) {
            $filename = uniqid() . '.' . $extension;
            $destination = $uploadDir . $filename;

            //new line
            echo "Uploading $file[name] => $destination";
            /*
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo "File uploaded: $filename\n";
            } else {
                echo "Error uploading file: $file[name]\n";
            }
            */
        } else {
            echo "Invalid file extension: $file[name]\n";
        }
    } else {
        echo "File too large or error: $file[name]\n";
    }
}

?>