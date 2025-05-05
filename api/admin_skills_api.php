<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");

    session_start();

    include "database.php";
    include "../class/Skills.php";

    $database = new Database();
    $conn = $database->getConnection();

    $skill = new Skills($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            $skills = $skill->getSkill();
            echo json_encode(["status" => "success", "skills" => $skills]);
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $skill->updateSkill($data["id"], $data["description"], $data["projectCompleted"], $data["clientsServed"], $data["yearsExperience"]);
            echo json_encode(["status" => "success"]);
            break;
    }
?>