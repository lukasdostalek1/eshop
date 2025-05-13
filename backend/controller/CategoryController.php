<?php
require_once __DIR__ . "/../service/CategoryService.php";
require_once __DIR__ . "/../model/ErrorLog.php";

session_start();

class CategoryController{
    private CategoryService $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService;
    }


    public function addCategory() {
     
        $catName = json_decode(file_get_contents("php://input"));
        $userId = $_SESSION["userId"];

        if (empty($catName)) {
            echo json_encode(["message" => "pole je prazdne"]);
            exit;
        }
        if($_SESSION["role"] != 1) {
        echo json_encode(["error" => "Chybí oprávnění na přidávání kategoriíí."]);
        exit;
        }

        try {
            $category = new Category($catName, $userId);

            if (!$category) {
                throw new Exception("Nepovedlo se vytvorit objekt category pomoci tridy Category");
            }

            $resultCategory = $this->categoryService->addCategory($category);

            if (!$resultCategory) {
            throw new Exception("Spatny result z categoryService->addCategory");
        }
        echo json_encode(["succes" => true]);
        }
        catch(Exception $e) {
        ErrorLog::logError($e);
        }
    }


    public function getCategoryById($id) {

        if(empty($id) || $id < 0) {
            echo json_encode(["error" =>"id chybí nebo je ve špatném formátu"]);
            exit;
        }

        try {
            $category = $this->categoryService->getCategoryById($id);
            
            if (!$category) {
                throw new Exception("nepodarilo se vybrat category pomoci id v getCategoryById | Category Controller");
            }
            echo json_encode($category);

        }
        catch(Exception $e) {
            ErrorLog::logError($e);
        }


    }

    public function getAllCategories() {

        try {
            $response =  $this->categoryService->getAllCategories();
            echo json_encode($response);
        }
        
        catch(Exception $e) {
            ErrorLog::logError($e);
        }

        
    }
}



?>
