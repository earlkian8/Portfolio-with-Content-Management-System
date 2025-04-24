<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include "database.php";
include "../class/Admin.php";

$database = new Database();
$conn = $database->getConnection();

$admin = new Admin($conn);

$method = $_SERVER["REQUEST_METHOD"];

if ($method == 'POST') {
    try {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON data");
        }

        if (empty($data["username"]) || empty($data["password"])) {
            throw new Exception("Username and password are required");
        }

        $username = $data["username"];
        $password = $data["password"];

        if ($admin->login($username, $password)) {
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            if ($_SESSION["loggedin"] == true) {
                header("Location: admin/home.php");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
}
?>