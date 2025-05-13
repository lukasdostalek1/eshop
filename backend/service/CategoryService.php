<?php
require_once __DIR__ . "/../model/ErrorLog.php";
require_once __DIR__ . "/../model/Database.php";
require_once __DIR__ . "/../model/Category.php";



class CategoryService {
    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConn();
    }


    public function addCategory(Category $category) {

        $stmt = $this->pdo->prepare("INSERT INTO category(name, user_id) VALUES (:name, :user_id)");
        
        $name = $category->getName();
        $userId = $category->getUserId();

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":user_id", $userId);
        
        try {
            if($stmt->execute()) {
                $categoryId = $this->pdo->lastInsertId();
                $category->setId($categoryId); 
                return $category;
            }
        
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return false;
        }
        
    }



    public function getCategoryById($id) {


  
        
        $stmt = $this->pdo->prepare("SELECT * FROM category WHERE id=:id");
        $stmt->bindParam(":id", $id);

        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se vykonat prikaz v getCategoryById | CATEGORYService");
            }
            $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$categoryData) {
                throw new Exception("Nepovedlo se ziskat produkt data z databaze pomoci idecka");
            }
            $category = new Category($categoryData["name"], $categoryData["user_id"],$categoryData["id"]);
            return $category;
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }




    }


    public function getAllCategories() {

        $stmt = $this->pdo->prepare("SELECT * FROM category");
        try {
            if($stmt->execute()) {
               $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
              return $categories;

            }
            else {
                throw new Exception("Nepovedlo se ziskat categories z databaze pomoci getCategories");
            }

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }

    }

}