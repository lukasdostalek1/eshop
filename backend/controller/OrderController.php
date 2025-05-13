<?php

require_once __DIR__ . "/../service/OrderService.php";
require_once __DIR__ . "/../model/ErrorLog.php";

session_start();

class OrderController {
    private OrderService $orderService;

    public function __construct() {
        $this->orderService = new OrderService;
    }


    public function placeOrder() {
        $data = json_decode(file_get_contents("php://input"), true);
        

        if(empty($data["deliveryAddress"]) || empty($data["paymentMethodValue"]) || empty($data["orderItems"])) {
            echo json_encode(["error" => "chybi vsechny hodnoty objednávky"]);
            exit;
        }
        
        $orderObject = $this->orderService->createOrderObject($data);

        $postedOrderWithDbId = $this->orderService->addOrder($orderObject);
        
        $deliveryAddressObject = $this->orderService->createDeliveryAddressObject($data, $postedOrderWithDbId);
        
        $resultDeliveryAddress = $this->orderService->addDeliveryAddress($deliveryAddressObject);

        $resultOrderItems = $this->orderService->addOrderItems($postedOrderWithDbId);

        if (!$resultOrderItems || !$resultDeliveryAddress) {
          echo json_encode(["error" => "Neúspěšné přijetí objednávky"]);
          exit;
        }
        
        echo json_encode($postedOrderWithDbId->getId());

    }




    public function getOrders() {
      $orders = null;
      if(!isset($_SESSION["userId"])) {
        echo json_encode(["error" => "nemate opravneni na zobrazeni objednavek"]);
        exit;
      }

      
      if($_SESSION["role"] == 1) {
        $orders = $this->orderService->getAllOrders();
       }
       else {
       $orders = $this->orderService->getOrdersByUserId($_SESSION["userId"]);
      }
      
       echo json_encode($orders);
       exit;

    }


  public function getOrderDetails($orderId) {
    if(!$_SESSION["isLoggedIn"]) {
      echo json_encode(["error" => "nemate opravneni na zobrazeni objednavek"]);
      exit;
    }
    if($_SESSION["role"] != 1) {
        $result = $this->orderService->checkPermissionToViewOrderDetails($orderId);
        if(!$result) {
        echo json_encode(["error"=> "nemate opravneni prohlizet tuto objednavku"]);
        exit;
      }
    }


    $orderDetails = $this->orderService->getOrderDetails($orderId);
    $orderItems = $this->orderService->getOrderItemsByOrderId($orderId);
    echo json_encode(["orderDetails"=> $orderDetails, "orderItems" => $orderItems]);
    
  } 
  
  
}

?>