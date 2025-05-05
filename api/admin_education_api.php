<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    session_start();

    include "database.php";
    include "../class/Education.php";

    $database = new Database();
    $conn = $database->getConnection();

    $education = new Education($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            $educations = $education->getAllEducation();
            echo json_encode(["status" => "success", "educations" => $educations]);
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $education->addEducation($data["degree"], $data["institution"], $data["startYear"], $data["endYear"], $data["description"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $education->updateEducation($data["id"], $data["degree"], $data["institution"], $data["startYear"], $data["endYear"], $data["description"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $education->deleteEducation($data["id"]);
            echo json_encode(["status" => "success"]);
            break;
    }
?>