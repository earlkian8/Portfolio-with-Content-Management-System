<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    session_start();

    include "database.php";
    include "../class/Programming.php";

    $database = new Database();
    $conn = $database->getConnection();

    $programming = new Programming($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            $programmings = $programming->getAllProgramming();
            echo json_encode(["status" => "success", "programmings" => $programmings]);
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $programming->addProgramming($data["name"], $data["iconClass"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $programming->updateProgramming($data["id"], $data["name"], $data["iconClass"]);
            echo json_encode(["status" => "message"]);
            break;
        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $programming->deleteProgramming($data["id"]);
            echo json_encode(["status" => "success"]);
            break;
    }
?>