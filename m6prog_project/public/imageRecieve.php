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

    // ✅ Ensure correct data types
    $stmt->bind_param("ssii", $file_name, $file_path, $file_size, $resolution);

    if ($stmt->execute()) {
        return true;
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
        list($width, $height) = getimagesize($fileName);
        $resolution = $width . "x" . $height;

        // ✅ Ensure `file_path` is correctly stored
        $file_path = realpath($fileName); // Convert to absolute path
        
        // ✅ Debugging: Check the actual file path
        error_log("File path: " . $file_path);

        // Insert into database
        $insertResult = insertImageinDb(basename($fileName), $file_path, $file["size"], $resolution);
        
        if ($insertResult === true) {
            return true;
        } else {
            return $insertResult; // Return error message
        }
    }

    return "Failed to move uploaded file.";
}

$response = ["succeeded" => false, "message" => ""];

if (isset($_FILES["image"])) {
    $file = $_FILES["image"];

    if ($file["error"] === 0) {
        $uploadResult = handleFiles($file);

        if ($uploadResult === true) {
            $response["succeeded"] = true;
            $response["message"] = "File uploaded successfully.";
        } else {
            $response["message"] = $uploadResult; // Display error message
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
