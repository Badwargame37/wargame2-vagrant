<?php
// Function to add files and sub-directories in a folder to zip file.
function addFolderToZip($folder, &$zipFile, $exclusiveLength) {
    $handle = opendir($folder);
    while (FALSE !== $f = readdir($handle)) {
        // Skip excluded files and folders
        if ($f != '.' && $f != '..') {
            $filePath = "$folder/$f";
            // Remove prefix from file path before add to zip
            $localPath = substr($filePath, $exclusiveLength);
            if (is_file($filePath)) {
                $zipFile->addFile($filePath, $localPath);
            } elseif (is_dir($filePath)) {
                // Add sub-directory.
                $zipFile->addEmptyDir($localPath);
                addFolderToZip($filePath, $zipFile, $exclusiveLength);
            }
        }
    }
    closedir($handle);
}

// Initialize archive object
$zip = new ZipArchive();
$zipFilename = "all_files.zip";

if ($zip->open($zipFilename, ZipArchive::CREATE) !== TRUE) {
    exit("Cannot open <$zipFilename>\n");
}

// Current directory to be zipped.
$folderPath = getcwd();

// Initialize the archive and set the name of the resulting zip file
addFolderToZip($folderPath, $zip, strlen("$folderPath/"));

// Zip archive will be created only after closing object.
$zip->close();

// Offer zip file for download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
header('Content-Length: ' . filesize($zipFilename));

readfile($zipFilename);

// Remove the zip file from the server (optional)
unlink($zipFilename);
?>
