<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

function insertImageinDb($file_name, $file_path, $file_size, $resolution)
{
    $conn = database_connect();
    $sql = "INSERT INTO Images (filename, file_path, file_size, resolution) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return "Database error: " . $conn->error;
    }

    $stmt->bind_param("ssis", $file_name, $file_path, $file_size, $resolution);

    if ($stmt->execute()) {
        return $conn->insert_id; // ✅ Return the last inserted ID instead of true
    } else {
        return "Database insert failed: " . $stmt->error;
    }
}

function handleFiles($file)
{   
    $link = uniqid();
    $location = $file["tmp_name"];
    $ext = pathinfo($file["name"], PATHINFO_EXTENSION) ?: "png"; // Get correct extension

    // ✅ Change path to absolute to avoid "0" issue
    $fileName = __DIR__ . "/../uploads/$link.$ext"; 

    if (move_uploaded_file($location, $fileName)) {
        $imageInfo = getimagesize($fileName);

        if ($imageInfo === false) {
            return "Invalid image file.";
        }

        list($width, $height) = $imageInfo;
        $resolution = $width . "x" . $height;

        // ✅ Convert file path to absolute
        $file_path = realpath($fileName);
        
        // ✅ Debugging: Check the actual file path and resolution
        error_log("File path: " . $file_path);
        error_log("Resolution: " . $resolution);

        // Insert into database and get file ID
        $fileid = insertImageinDb(basename($fileName), $file_path, $file["size"], $resolution);
        
        if (is_numeric($fileid)) {
            return $fileid; // ✅ Return the file ID instead of true
        } else {
            return $fileid; // Return error message
        }
    }

    return "Failed to move uploaded file.";
}

function createLink($fileid)
{
    return "http://" . $_SERVER['HTTP_HOST'] . "/imagedownload.php?file=" . urlencode($fileid);
}

$response = ["succeeded" => false, "message" => "", "downloadlink" => null];

if (isset($_FILES["image"])) {
    $file = $_FILES["image"];

    if ($file["error"] === 0) {
        $fileid = handleFiles($file);

        if (is_numeric($fileid)) {
            $response["succeeded"] = true;
            $response["message"] = "File uploaded successfully.";
            $response["downloadlink"] = createLink($fileid); // ✅ Now stores the link correctly
        } else {
            $response["message"] = $fileid; // Display error message
        }
    } else {
        $response["message"] = "Error during upload: " . $file["error"];
    }
} else {
    $response["message"] = "No file uploaded.";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>