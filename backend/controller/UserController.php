<?php
require_once __DIR__ . "/../service/UserService.php";
require_once __DIR__ . "/../model/ErrorLog.php";

session_start();

class UserController {
    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService;
    }




    public function createUser() {

        
        $data = json_decode(file_get_contents("php://input"), true);


        if(empty($data["email"]) || empty($data["name"]) || empty($data["password"])) {
        echo json_encode(["error" => "Nejsou vyplněna všechna povinná pole"]);
        exit;
        }
        if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Email je ve spatnem formatu"]);
        exit;
        }
        if(strlen($data["password"]) < 8) {
        echo json_encode(["error" => "Heslo musi mit minimalne 8 znaku"]);
        exit;
        }



        try {
            $response = $this->userService->isEmailInDatabase($data["email"]);

            if ($response) {
                echo json_encode(["error" => "Tento e-mail je již zaregistrovaný, prosím přihlašte se."]);
                exit;
            }

            $user = new User($data["name"], $data["surname"],$data["email"], $data["password"]);

            $saved_user = $this->userService->createUser($user);

            if ($saved_user) {
                $_SESSION["userId"] = $saved_user->getId();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["role"] = $saved_user->getRole();
                echo json_encode(["redirect" => true]);
            }
            else {
                echo json_encode(["error" => "Došlo k chybě při registraci na serveru"]);
                throw new Exception("Chyba v createUser metodě.");
            }
            }
            catch(Exception $e) {
                ErrorLog::logError($e);
            }
    

        }


    public function check_sessions() {

            if(isset($_SESSION["isLoggedIn"]) && !is_null($_SESSION["userId"])) {
                echo json_encode(["isLoggedIn" => true, "userId" => $_SESSION["userId"], "role" => $_SESSION["role"]]);
                }
                else {
                 echo json_encode(["isLoggedIn" => false, "message" => "nejste prihlaseni", "role" => null]);
                }

    }

    public function logOut() {
        $_SESSION = [];

        // Zničí session cookie (volitelné, ale doporučené)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        echo json_encode(["succes" => true]);
    }


    
    
    
    
    
    public function authentization() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(empty($data["email"]) || empty($data["password"])) {
        echo json_encode(["error" => "Nejsou vyplněna všechna povinná pole."]);
        exit;
        }
        if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "neplatna forma emailu"]);
        exit;
        }
        try {
            $user = $this->userService->authentization($data["email"], $data["password"]);
            if (!$user) {
                echo json_encode(["error" => "neplatne prihlasovaci udaje"]);
                exit;
            }

            $_SESSION["userId"] = $user->getId();
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["role"] = $user->getRole();
            echo json_encode(["redirect" => true]);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }
        
    }


    public function getLoggedData() {

        $userId = $_SESSION["userId"]; 
        
        try {
            $user = $this->userService->getUserById($userId);
            
            if (!$user) {
                throw new Exception("User Data se nepovedlo ziskat v getUserDataById UserController");
                echo json_encode(["error" => "nepovedlo se ziskat userData"]);
                exit;
            }

            echo json_encode($user);
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }

    }

    public function editUserData() {

        $input = json_decode(file_get_contents("php://input"), true);


        if(empty($input["password"]) || empty($input["name"]) || empty($input["surname"])) {
            echo json_encode(["error" => "Nejsou vyplněna všechna povinná pole"]);
            exit;
        }
    

        try {
            $userId = $_SESSION["userId"]; 
            $user = $this->userService->getUserById($userId);

            $responseUser = $this->userService->authentization($user->getEmail(), $input["password"]);

            if(!$responseUser) {
                echo json_encode(["error" => "Špatné heslo, změny nebyly provedeny."]);
                exit;
            }

            $result = $this->userService->editUserData($userId, $input["name"], $input["surname"]);

            if(!$result) {
                throw new Exception("nešlo provést změny v editUserData | UserController");
            }

            echo json_encode(["succes" => $result, "message" => "Změna byla úspěšně provedena."]);
        }

        catch(Exception $e) {
            ErrorLog::logError($e);
        }





    
    }


    public function changePassword() {

        $input = json_decode(file_get_contents("php://input"),true);


        if (empty($input["oldPassword"]) || empty($input["newPassword"])) {
            echo json_encode(["error" => "Nejsou vyplněna potřebná pole."]);
            exit;
        }
        if (strlen($input["newPassword"]) < 8) {
            echo json_encode(["error" => "Nové heslo není delší jak 8 znaků."]);
            exit;
        }
        
        try {
            $userId = $_SESSION["userId"]; 
            $user = $this->userService->getUserById($userId);

            $responseUser = $this->userService->authentization($user->getEmail(), $input["oldPassword"]);

            if(!$responseUser) {
                echo json_encode(["error" => "Špatné heslo, změny nebyly provedeny."]);
                exit;
            }
            
            $result=  $this->userService->changePassword($userId, $input["newPassword"]);

            if(!$result) {
            echo json_encode(["error" => "chyba"]);
                exit;
            }

            echo json_encode(["succes" => $result]);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        echo json_encode(["succes" => false, "message" => "chyba"]);
        }
        

    }

    }