<?php

require_once "controller/UserController.php";

header("Content-Type: application/json");



$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$baseUrl = $_SERVER['SCRIPT_NAME'];

$rowPath = parse_url($uri, PHP_URL_PATH);
$path = str_replace($baseUrl, "", $rowPath);

$userController = new userController();

switch($path) {
    case "/register":
        if($method === "POST") {
            $userController->createUser();
        }
        else {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        break;
    case "/sign_in":
        if($method === "POST"){
            $userController->authentization();
        }
        else {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        break;
    case "/check_sessions":
        if($method === "GET") {
        $userController->check_sessions();
        }
        else {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        break;
    
    case "/getLoggedData":
        if($method === "GET") {
            $userController->getLoggedData();
        }
        else {
            echo json_encode(["error" =>"nepovolena metoda"]) ;
        }
    break;
    case "/editUserData":
        if($method === "POST") {
            $userController->editUserData();
        }
        else {
            echo json_encode(["error" =>"nepovolena metoda"]) ;
        }
        break;
        case "/changePassword":
            if($method === "POST") {
                $userController->changePassword();
            }
            else {
                echo json_encode(["error" =>"nepovolena metoda"]) ;
            }
            break;
    case "/log_out":
        if($method === "GET") {
            $userController->logOut();
        }
        else {
            echo json_encode(["error" => "nepovolena metoda"]);
        }
        break;
        default:
        echo json_encode(["error" => "nepovolena cesta"]);

}