<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include "database.php";
include "../class/Projects.php";

$database = new Database();
$conn = $database->getConnection();

$project = new Projects($conn);

$method = $_SERVER["REQUEST_METHOD"];


switch ($method){
    case 'GET':
        $projects = $project->getAllProjects();
        echo json_encode(["status" => "success", "projects" => $projects]);
        break;
    case 'POST':
        if (!isset($_SESSION['loggedin'])) {
            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            break;
        }

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $technologiesUsed = $_POST['technologiesUsed'] ?? '';
        $url = $_POST['url'] ?? '';
        $github = $_POST['github'] ?? '';
        $image = null;

        if (isset($_FILES['image'])) {
            $uploadDir = "../Uploads/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            
            $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExt, $allowedTypes)) {
                throw new Exception("Invalid file type");
            }
            
            if ($_FILES['image']['size'] > $maxSize) {
                throw new Exception("File size exceeds limit");
            }

            $fileName = uniqid() . '.' . $fileExt;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $fileName;
            } else {
                throw new Exception("File upload failed");
            }
        }

        $project->addProject($title, $description, $image, $technologiesUsed, $url, $github);
        echo json_encode(["status" => "success"]);
        break;
    case 'PUT':
        if (!isset($_SESSION['loggedin'])) {
            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            break;
        }
        $projectId = $_POST["projectId"] ?? '';
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $technologiesUsed = $_POST['technologiesUsed'] ?? '';
        $url = $_POST['url'] ?? '';
        $github = $_POST['github'] ?? '';
        $image = null;

        if (isset($_FILES['image'])) {
            $uploadDir = "../Uploads/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            
            $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExt, $allowedTypes)) {
                throw new Exception("Invalid file type");
            }
            
            if ($_FILES['image']['size'] > $maxSize) {
                throw new Exception("File size exceeds limit");
            }

            $fileName = uniqid() . '.' . $fileExt;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $fileName;
            } else {
                throw new Exception("File upload failed");
            }
        }

        $project->updateProject($projectId, $title, $description, $image, $technologiesUsed, $url, $github);
        echo json_encode(["status" => "success"]);
        break;
    case 'DELETE':
        $delData = file_get_contents("php://input");
        $data = json_decode($delData, true);

        $project->deleteProject($data["projectId"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>