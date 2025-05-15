<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include "database.php";
include "../class/Services.php";

$database = new Database();
$conn = $database->getConnection();

$s = new Services($conn);

$method = $_SERVER["REQUEST_METHOD"];


switch ($method){
    case 'GET':
        $services = $s->getServices();
        echo json_encode(["status" => "success", "services" => $services]);
        break;
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $s->addServices($data["name"], $data["description"]);
        echo json_encode(["status" => "success"]);
        break;
    case 'PUT':
        $putData = file_get_contents("php://input");
        $data = json_decode($putData, true);

        $s->updateServices($data["serviceId"], $data["name"], $data["description"]);
        echo json_encode(["status" => "success"]);
        break;
    case 'DELETE':
        $delData = file_get_contents("php://input");
        $data = json_decode($delData, true);

        $s->deleteServices($data["serviceId"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>