<?php
require_once __DIR__ . "/../model/ErrorLog.php";
require_once __DIR__ . "/../model/Database.php";
require_once __DIR__ . "/../model/User.php";

class UserService{
    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConn();
    }



    public function createUser(User $user) {

        $stmt = $this->pdo->prepare("INSERT INTO user(name, surname, email,password) VALUES (:name, :surname, :email, :password)");

        $name = $user->getName();
        $surname = $user->getSurname();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(),PASSWORD_DEFAULT);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        try {
            if($stmt->execute()) {
                $userId = $this->pdo->lastInsertId();
                $user->setId($userId); 
                return $user;
            }
            else {
                throw new Exception("chyba v metodě createUser");
            }
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }

    }

    public function isEmailInDatabase($email)  {

        $stmt = $this->pdo->prepare("SELECT id FROM user WHERE email=:email");
        $stmt->bindParam(":email", $email);


        try {
            if($stmt->execute()) {
               $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($data) {
                    return true;
                }
                else {
                    return false;
                }

            }
            else {
                throw new Exception("Nepovedlo se zkontrolovat databazi na email duplicitu");
            }

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }



    }

    public function authentization($email, $password) {

        $stmt = $this->pdo->prepare("SELECT id, name, surname, email, password, role FROM user WHERE email=:email");
        $stmt->bindParam(":email", $email);


        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se vykonat authentization v UserService");
                exit;
            }
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$userData) {
                return false;
                exit;
            }
            if(!password_verify($password, $userData["password"])) {
                  return false;
                  exit;
            }

            $user = new User($userData["name"],$userData["surname"],$userData["email"],$userData["password"],$userData["role"], $userData["id"]);

            if (!$user) {
                throw new Exception("Nepovedlo se vytvorit Usera v UserService authentization"); 
                return false;
            }

            return $user;
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }






    }



    public function getUserById($id) {

        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id=:id");
        $stmt->bindParam(":id", $id);

        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se ziskat data z databaze pomoci idecka");
            }
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$userData) {
                throw new Exception("Uzivatel s id neexistuje"); 
                return false;
            }


            $user = new User($userData["name"],$userData["surname"],$userData["email"],$userData["password"],$userData["role"], $userData["id"]);

            return $user;



        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }



    }


    
    public function editUserData($id, $name, $surname) {

        $stmt = $this->pdo->prepare("UPDATE user SET name=:name, surname=:surname WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);

        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se zmenit jmeno uzivatele");
                return false;
            }
            return true;
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }

    }


    public function changePassword($id, $newPassword) {

        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $this->pdo->prepare("UPDATE user SET password=:password WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":password", $hashed_password);

        try {
            if($stmt->execute()) {
            return true;
            }
            else {
                throw new Exception("Nepovedlo se zmenit heslo uzivatele | chyba v UserService");
                return false;
            }

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }

    }
}