<?php
// IMPORTANT: The file path is now set to your _includes folder.
$file = $_GET['file'];

// --- SECURITY CHECK ---
// Use basename() to prevent directory traversal attacks.
$safe_file = basename($file);

// Define the directory where your files are stored.
$file_directory = '_includes/';

// Build the full path to the file
$file_path = $file_directory . $safe_file;

// --- CHECK IF FILE EXISTS ---
if (!file_exists($file_path)) {
    http_response_code(404);
    die('Error: The requested file was not found.');
}

// --- SEND HTTP HEADERS FOR DOWNLOAD ---
if (ob_get_level()) {
    ob_end_clean();
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));

// --- READ AND OUTPUT THE FILE ---
readfile($file_path);

exit;
?>
