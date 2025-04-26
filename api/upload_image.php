<?php
header("Content-Type: application/json");
session_start();

if (!isset($_SESSION['loggedin'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}

if (!isset($_FILES['profile_image'])) {
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
    exit;
}

try {
    $uploadDir = "../uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $fileExt = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '.' . $fileExt;
    $targetPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
        echo json_encode(["status" => "success", "fileName" => $fileName]);
    } else {
        echo json_encode(["status" => "error", "message" => "File upload failed"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>