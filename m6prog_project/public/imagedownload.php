<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

$downloadFile = $_GET["file"] ?? null; // Avoid errors if 'file' is missing

$conn = database_connect();
$downloadResult = FindImage($conn, $downloadFile);
$conn->close();

// ✅ Fix: Check if exactly 1 result was found
if (count($downloadResult) == 1) {
    $filename = $downloadResult[0]["file_path"]; // ✅ Use 'file_path', not 'filename'

    // ✅ Ensure the file exists before opening
    if (!file_exists($filename)) {
        die("File not found.");
    }

    // ✅ Open the file safely
    $filepointer = fopen($filename, 'rb');
    if (!$filepointer) {
        die("Error opening file.");
    }

    // ✅ Set correct headers
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($filename));

    // ✅ Send the file to the browser
    fpassthru($filepointer);
    fclose($filepointer);
    exit;
} else {
    die("Invalid file ID.");
}

// ✅ Function to Convert Query Results to an Associative Array
function GetQueryResultsAssoc($result)
{
    $results = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
    return $results;
}

// ✅ Function to Find the File Information from the Database
function FindImage($conn, $file)
{
    if (!$conn) {
        die("Database connection failed.");
    }

    if (!$file) {
        die("File ID is missing.");
    }

    try {
        $q = "SELECT * FROM Images WHERE id = ?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param('s', $file);
        $stmt->execute();
        $result = $stmt->get_result();
        return GetQueryResultsAssoc($result);
    } catch (Exception $ex) {
        error_log("Error during query: " . $ex->getMessage());
        die("Error retrieving file information.");
    }
}
?>