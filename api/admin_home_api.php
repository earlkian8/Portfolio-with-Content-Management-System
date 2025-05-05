<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include "database.php";
include "../class/Home.php";

$database = new Database();
$conn = $database->getConnection();

$home = new Home($conn);

$method = $_SERVER["REQUEST_METHOD"];

try {
    switch ($method) {
        case 'GET':
            $homeData = $home->getHome();
            echo json_encode(["status" => "success", "homeData" => $homeData]);
            break;
            
        case 'POST':
            if (!isset($_SESSION['loggedin'])) {
                http_response_code(401);
                echo json_encode(["status" => "error", "message" => "Unauthorized"]);
                break;
            }

            $name = $_POST['name'] ?? '';
            $designation = $_POST['designation'] ?? '';
            $tagline = $_POST['tagline'] ?? '';
            $profile_image = null;

            if (isset($_FILES['profile_image'])) {
                $uploadDir = "../Uploads/";
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB
                
                $fileExt = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
                if (!in_array($fileExt, $allowedTypes)) {
                    throw new Exception("Invalid file type");
                }
                
                if ($_FILES['profile_image']['size'] > $maxSize) {
                    throw new Exception("File size exceeds limit");
                }

                $fileName = uniqid() . '.' . $fileExt;
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
                    $profile_image = $fileName;
                } else {
                    throw new Exception("File upload failed");
                }
            }

            $result = $home->updateHome($name, $designation, $tagline, $profile_image);
            
            if ($result) {
                $response = ["status" => "success"];
                if ($profile_image) {
                    $response["profile_image"] = $profile_image;
                }
                echo json_encode($response);
            } else {
                echo json_encode(["status" => "error", "message" => "Database update failed"]);
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Method not allowed"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

$conn = null;
?>