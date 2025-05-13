<?php

require_once __DIR__ . "/../service/ProductService.php";
require_once __DIR__ . "/../model/ErrorLog.php";

session_start();

class ProductController {
    private ProductService $productService;

    public function __construct() {
        $this->productService = new ProductService;
    }

    public function addProduct() {
   
        if(empty($_SESSION["userId"]) || $_SESSION["role"] != 1) {
            echo json_encode(["error" => "Chybí oprávnění na přidávání produktů."]);
            exit;
        }
        
        if(empty($_POST["categoryId"]) || empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["price"]) || empty($_FILES["image"])) {
        echo json_encode(["error" => "Nejsou vyplněny všechny hodnoty."]);
        exit;
        }

            $categoryId = $_POST["categoryId"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $image = $_FILES["image"];
            $userId = $_SESSION["userId"];
            $image_error = $_FILES["image"]["error"];
            $image_size = $_FILES["image"]["size"];
            $image_name = $_FILES["image"]["name"];
            $image_tmp_path = $_FILES["image"]["tmp_name"];
            
        if($image_error) {
        echo json_encode(["error" => $image_error]);
        exit;
        }
        if ($image_size > 10000000) {
            echo json_encode(["error" => "obrazek je prilis velky"]);
            exit;
        }
        
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_img_extensions = ["jpg", "jpeg", "png", "webp"];
        
        if (!in_array($image_extension, $allowed_img_extensions)) {
            echo json_encode(["error" => "obrazek nema povolenou priponu (jpeg, jpg, png, webp)"]);
            exit;
        }
        
        $new_image_name = uniqid("img_", true) . "." . $image_extension;
        
        $image_upload_path =  "../uploads/" . $new_image_name;

        try{
        if (!move_uploaded_file($image_tmp_path, $image_upload_path)){
            throw new Exception("nepodarilo se nahrat obrazek");
            exit;
        }
        
        $product = new Product($name, $description, $price, $new_image_name, $userId, $categoryId);
        
        if(!$product) {
            throw new Exception("nepodarilo se vytvorit objekt Product");
        }

        $resultProduct = $this->productService->addProduct($product);

        if(!$resultProduct) {
         echo json_encode(["error" => "chyba na straně serveru."]);
         throw new Exception("nevrátil se user z productService.");
         exit;
        }
        
        echo json_encode(["succes" => true, "message" => "produkt upesne nahran"]);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }
    


    }



    public function getAllProducts() {

            $productsList = $this->productService->getAllProducts();
        
            if($productsList) {
                echo json_encode($productsList);
                return;
            }
            echo json_encode(["error" => "Produkty nenalezeny."]);
        


        
            }
        

    public function getProductById($id) {

        if(empty($id) || $id < 0) {
            echo json_encode(["error" =>"id chybí nebo je ve špatném formátu"]);
            exit;
        }

        
        try {
            $product = $this->productService->getProductById($id);
            
            if (!$product) {
                throw new Exception("nepodarilo se vybrat produkt pomoci id v getProductById | Product Controller");
            }
            echo json_encode($product);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }




    }




    public function getProductsByCategoryId($id) {
     
        if(empty($id) || $id < 0) {
            throw new Exception("id nepřišlo do getProductsByCategoryId | ProductController");
            exit;
        }

        
        try {
            $products = $this->productService->getProductsByCategoryId($id);
    
            if (!$products) {
             echo json_encode(["error" => "V této kategorii se nenachází žádný produkt"]);
             exit;
            }


            echo json_encode($products);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }



    }
}

?>