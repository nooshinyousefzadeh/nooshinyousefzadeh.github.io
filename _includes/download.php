<?php
// Ensure the script only runs for a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // IMPORTANT: Sanitize and validate the filename to prevent directory traversal attacks
    $filename = basename($_GET['file']);

    // Define the directory where your files are stored (it should be outside the web root if possible)
    $file_path = 'path/to/your/files/' . $filename; // <-- **Change this to your file directory**

    // Check if the file exists on the server
    if (file_exists($file_path)) {
        // Set the appropriate headers for a file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Read the file and send its contents to the user
        readfile($file_path);
        
        // Exit the script
        exit;
    } else {
        // File does not exist, show an error
        http_response_code(404);
        die('File not found!');
    }
}
?>
