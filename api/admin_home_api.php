<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include "../config/database.php";
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
            
        case 'PUT':
            if (!isset($_SESSION['loggedin'])) {
                http_response_code(401);
                echo json_encode(["status" => "error", "message" => "Unauthorized"]);
                break;
            }
            
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON data");
            }
            
            $result = $home->updateHome(
                $data['name'] ?? '',
                $data['designation'] ?? '',
                $data['tagline'] ?? '',
                $data['profile_image'] ?? null
            );
            
            if ($result) {
                $response = ["status" => "success"];
                if (isset($data['profile_image'])) {
                    $response["profile_image"] = $data['profile_image'];
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
?>