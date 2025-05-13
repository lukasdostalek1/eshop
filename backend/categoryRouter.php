<?php

require_once "controller/CategoryController.php";

header("Content-Type: application/json");



$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$baseUrl = $_SERVER['SCRIPT_NAME'];

$rowPath = parse_url($uri, PHP_URL_PATH);
$path = str_replace($baseUrl, "", $rowPath);

$categoryController = new categoryController();

switch($path) {
    case "/getCategoryById":
        if(!$method === "GET") {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        if(!isset($_GET["id"])) {
            echo json_encode(["error" => "chybi GET parametr"]);
        }
        $categoryController->getCategoryById($_GET["id"]);
        break;
        case "/getAllCategories":
        if(!$method === "GET") {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        $categoryController->getAllCategories();
        break;
        case "/addCategory":
            if(!$method === "POST") {
                echo json_encode(["error" => "nepovolena metoda"]);
            }
            $categoryController->addCategory();
            break;
        default:
        echo json_encode(["error" => "nepovolena cesta"]);

}