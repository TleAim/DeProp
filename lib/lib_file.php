<?php
function printUploadedFilesInfo($fileArr) {
    if (!empty($fileArr)) {
      foreach ($fileArr as $file) {
        $fileName = $file['name'];
        $fileSize = $file['size'];
        
        echo "Filename: " . $fileName . "<br>";
        echo "Filesize: " . $fileSize . " bytes<br><br>";
      }
    } else {
      echo "No files uploaded.";
    }
  }

  
function deleteFilesWithPrefix($folder, $prefix) {
    // Check if the folder exists
    if (file_exists($folder) && is_dir($folder)) {
        // Get all files in the folder
        $files = glob($folder . '*');

        // Print out the number of files found
        $numFiles = count($files);
        //echo "<br>Found " . $numFiles . " files\n";
        
        //echo "<br>--------- DELETE FILE ---------";
        // Loop through the files
        foreach ($files as $file) {
            // Check if the file name starts with the specified prefix
            if (strpos(basename($file), $prefix) === 0) {
                // Delete the file
                if (unlink($file)) {
                    //echo "<br>Deleted file: " . $file . "\n";
                } else {
                    //echo "<br>Error deleting file: " . $file . "\n";
                }
            }
        }
    } else {
        echo "<br>Folder not found: " . $folder . "\n";
    }
}


function moveAndRenameFile($oldFilePath, $newFilePath) {

    // Move and rename the file
    if (file_exists($oldFilePath)) {
        if (rename($oldFilePath, $newFilePath)) {
            //echo "<br>Renamed successfully : ".$oldFilePath." => ".$newFilePath;
        } else {
            //echo "<br>Error : ".$oldFilePath." => ".$newFilePath;
        }
    }else{
        //echo $oldFilePath." File not exists <br>";
    }
}

function saveFile($uploadDir, $fileArr, $uid)
{
    $i = 0;
    foreach ($fileArr as $file) {
        if ($file['error'] === 0 && $file['size'] <= 5 * 1024 * 1024) {

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($extension), $allowedExtensions)) {
                $filename = $uid . '_' . $i++ . '.' . 'jpg';
                $destination = $uploadDir . $filename;

                // Just move the uploaded file to the destination without converting
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    //echo "File uploaded: $filename\n";
                } else {
                    //echo "Error uploading file: $file[name]\n";
                }

            } else {
                //echo "Invalid file extension: $file[name]\n";
            }
        } else {
            //echo "File too large or error: $file[name]\n";
        }
    }
}


function saveFile2($uploadDir,$fileArr,$uid){

    $i=0;
    foreach ($fileArr as $file) {
        if ($file['error'] === 0 && $file['size'] <= 5 * 1024 * 1024) {

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($extension), $allowedExtensions)) {
                $filename = $uid.'_'.$i++. '.' . '.jpg';
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
}

?>


