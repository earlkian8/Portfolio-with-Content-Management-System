<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    session_start();

    include "database.php";
    include "../class/Experience.php";

    $database = new Database();
    $conn = $database->getConnection();

    $experience = new Experience($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            $experiences = $experience->getAllExperience();
            echo json_encode(["status" => "success", "experiences" => $experiences]);
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $experience->addExperience($data["position"], $data["company"], $data["startYear"], $data["endYear"], $data["description"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $experience->updateExperience($data["id"], $data["position"], $data["company"], $data["startYear"], $data["endYear"], $data["description"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $experience->deleteExperience($data["id"]);
            echo json_encode(["status" => "success"]);
            break;

    }
?>