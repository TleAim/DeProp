
<?php
session_start();

$uploadDir = './upload/tmp/';
$prefix = $_SESSION['uid'];
deleteFilesWithPrefix($uploadDir, $prefix);

$i=0;
foreach ($_FILES as $file) {
    if ($file['error'] === 0 && $file['size'] <= 5 * 1024 * 1024) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($extension), $allowedExtensions)) {
            $filename = $_SESSION['uid'].'_'.$i++. '.' . '.jpg';
            $destination = $uploadDir . $filename;

            // Create image resource from the original image
            switch (strtolower($extension)) {
                case 'jpg':
                case 'jpeg':
                    $source = imagecreatefromjpeg($file['tmp_name']);
                    break;
                case 'png':
                    $source = imagecreatefrompng($file['tmp_name']);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($file['tmp_name']);
                    break;
            }


            /*
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo "File uploaded: $filename\n";
            } else {
                echo "Error uploading file: $file[name]\n";
            }
            */
            // Convert the image to JPG and save it
            if ($source && imagejpeg($source, $destination, 100)) {
                echo "File uploaded: $filename\n";
            } else {
                echo "Error uploading file: $file[name]\n";
            }

            // Free up memory
            if ($source) {
                imagedestroy($source);
            }

        } else {
            echo "Invalid file extension: $file[name]\n";
        }
    } else {
        echo "File too large or error: $file[name]\n";
    }
}

function deleteFilesWithPrefix($folder, $prefix) {
    // Check if the folder exists
    if (file_exists($folder) && is_dir($folder)) {
        // Get all files in the folder
        $files = glob($folder . '*');

        // Loop through the files
        foreach ($files as $file) {
            // Check if the file name starts with the specified prefix
            if (strpos(basename($file), $prefix) === 0) {
                // Delete the file
                if (unlink($file)) {
                    echo "Deleted file: " . $file . "\n";
                } else {
                    echo "Error deleting file: " . $file . "\n";
                }
            }
        }
    } else {
        echo "Folder not found: " . $folder . "\n";
    }
}
?>