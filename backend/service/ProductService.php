<?php
require_once __DIR__ . "/../model/ErrorLog.php";
require_once __DIR__ . "/../model/Product.php";
require_once __DIR__ . "/../model/Database.php";

class ProductService {
    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConn();
    }


    public function addProduct(Product $product) {
     

        $stmt = $this->pdo->prepare("INSERT INTO product(name, description, price, image_name, user_id, category_id) VALUES (:name, :description, :price, :image_name, :user_id, :category_id)");

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $image_name = $product->getImageFileName();
        $userId = $product->getUserId();
        $categoryId = $product->getCategoryId();

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":image_name", $image_name);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":category_id", $categoryId);

        try {
            if($stmt->execute()) {
                $productId = $this->pdo->lastInsertId();
                $product->setId($productId); 
                return $product;
            }

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return false;
        }


    }
    
    
    public function getAllProducts() {

        
        $stmt = $this->pdo->prepare("SELECT * FROM product");
        try {
            if($stmt->execute()) {
               $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $products;
            }
            else {
                throw new Exception("Nepovedlo se ziskat produkty z databaze pomoci getAllProducts");
            }

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }



    }

    public function getProductById($id) {

        
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE id=:id");
        $stmt->bindParam(":id", $id);

        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se vykonat prikaz v getProductById | ProductService");
            }
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$productData) {
                throw new Exception("Nepovedlo se ziskat produkt data z databaze pomoci idecka");
            }
            $product = new Product($productData["name"], $productData["description"], $productData["price"], $productData["image_name"], $productData["user_id"], $productData["category_id"], $productData["id"]);
            return $product;
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }


    }


    public function getProductsByCategoryId($category_id) {

        
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE category_id=:category_id");
        $stmt->bindParam(":category_id", $category_id);

        try {
            if(!$stmt->execute()) {
                throw new Exception("Nepovedlo se vykonat prikaz v getProductsByCategoryId | ProductService");
            }
            $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(!$productData) {
              return null;
            }

            $products = [];
            
            foreach ($productData as $product) {
                $products[] = new Product($product["name"],$product["description"],$product["price"],$product["image_name"],$product["user_id"],$product["category_id"],$product["id"]);
            }

            if(!$products) {
                throw new Exception("Neslo vytvorit pole objektu Product v getProductsByCategoryId");
            }

            return $products;
        }
        catch(Exception $e) {
            ErrorLog::logError($e);
            return null;
        }


    }



}