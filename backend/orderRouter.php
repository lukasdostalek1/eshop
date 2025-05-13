<?php

require_once "controller/OrderController.php";

header("Content-Type: application/json");



$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$baseUrl = $_SERVER['SCRIPT_NAME'];

$rowPath = parse_url($uri, PHP_URL_PATH);
$path = str_replace($baseUrl, "", $rowPath);


$orderController = new orderController();

switch($path) {
   
        case "/getOrders":
        if (!$method === "GET") {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        $orderController->getOrders();
        break;
       
        case "/placeOrder":
            if (!$method === "POST") {
                echo json_encode(["error" => "nepovolena metoda"]);
            }
            $orderController->placeOrder();
            break;
        case "/getOrderDetails":
            if(!$method === "GET") {
                echo json_encode(["error" => "nepovolena metoda"]);
            }
            if(!isset($_GET["id"])) {
                echo json_encode(["error" => "chybi GET parametr"]);
            }
            $orderController->getOrderDetails($_GET["id"]);
            break;
        default:
        echo json_encode(["error" => "nepovolena cesta"]);

}