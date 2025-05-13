<?php

require_once "controller/ProductController.php";

header("Content-Type: application/json");



$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$baseUrl = $_SERVER['SCRIPT_NAME'];

$rowPath = parse_url($uri, PHP_URL_PATH);
$path = str_replace($baseUrl, "", $rowPath);


$productController = new productController();

switch($path) {
    case "/getAllProducts":
        if($method === "GET") {
            $productController->getAllProducts();
        }
        else {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        break;
    case "/getProductById":
        if(!$method === "GET") {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        if(!isset($_GET["id"])) {
            echo json_encode(["error" => "chybi GET parametr"]);
        }
        $productController->getProductById($_GET["id"]);
        break;
        case "/addProduct":
            if (!$method === "POST") {
                echo json_encode(["error" => "nepovolena metoda"]);
            }
            $productController->addProduct();
            break;
            case "/getProductsByCategoryId":
                if(!$method === "GET") {
                    echo json_encode(["error" => "nepovolena metodda"]);
                };
                if(!isset($_GET["id"])) {
                     echo  json_encode(["error" => "chybi get parametr"]);
                    };
                $productController->getProductsByCategoryId($_GET["id"]);
                break;
        default:
        echo json_encode(["error" => "nepovolena cesta"]);

}