<?php

require_once __DIR__ . "/../model/ErrorLog.php";
require_once __DIR__ . "/../model/Database.php";
require_once __DIR__ . "/../model/Order.php";
require_once __DIR__ . "/../model/OrderItem.php";
require_once __DIR__ . "/../model/DeliveryAddress.php";
require_once __DIR__ . "/ProductService.php";


class orderService {
    private PDO $pdo;
    private ProductService $productService;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConn();
        
        $this->productService = new ProductService;
    }



    public function createOrderObject($data) {

    $userId = null;
    $guestName = null;
    $guestSurname = null;
    $guestEmail = null;

    $payment_method = $data["paymentMethodValue"];

    if(!isset($data["guestInfo"])) {
    $userId = $_SESSION["userId"];
    }
    else {
        $guestName = $data["guestInfo"]["name"];
        $guestSurname = $data["guestInfo"]["surname"];
        $guestEmail = $data["guestInfo"]["email"];
    }
    
    $order = new Order($payment_method, $userId, $guestName, $guestSurname, $guestEmail);


    foreach($data["orderItems"] as $orderItem) {
        $product = $this->productService->getProductById($orderItem["product_id"]);
        $orderItem = new OrderItem($product, $orderItem["quantity"], $orderItem["productSize"], $orderItem["productColor"]);
        $order->addOrderItem($orderItem);
    }

    return $order;
}

public function createDeliveryAddressObject($data, $postedOrderWithDbId) {
    
    $street = $data["deliveryAddress"]["street"];
    $street_number =  $data["deliveryAddress"]["street_number"];
    $city =  $data["deliveryAddress"]["city"];
    $zip_code =  $data["deliveryAddress"]["zip_code"];
    
    $address = new DeliveryAddress($street, $street_number, $city, $zip_code, $postedOrderWithDbId);
    return $address;
}


public function addOrder(Order $order) {

    $stmt = $this->pdo->prepare("INSERT INTO order_table(date, price, payment_method, user_id, guest_name, guest_surname, guest_email) VALUES 
    (:date, :price, :payment_method, :user_id, :guest_name, :guest_surname,:guest_email)");


    try {
        if($stmt->execute([
            'date' => $order->getDate(),
            'price' =>$order->getPrice(),
            'payment_method' => $order->getPaymentMethod(),
            'user_id' => $order->getUserId(),
            'guest_name' => $order->getGuestName(),
            'guest_surname' => $order->getGuestSurname(),
            'guest_email' => $order->getGuestEmail()
        ])) {
            $orderId = $this->pdo->lastInsertId();
            $order->setId($orderId); 
            return $order;
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


public function addOrderItems(Order $order) {
    $order_id = $order->getId();
    $orderItems =  $order->getOrderItems();
    $errors = [];

    foreach($orderItems as $orderItem) {
        
    $stmt = $this->pdo->prepare("INSERT INTO order_item(price, order_table_id, product_id) VALUES 
    (:price, :order_table_id, :product_id)");


    try {
        if(!$stmt->execute([
            'price' => $orderItem->getItemPrice(),
            'order_table_id' => $order_id,
            'product_id' => $orderItem->getProductId()
        ])) {
            $errors = true;
            throw new Exception("chyba v metodě addOrderItem");
        }
    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }

    }

    if($errors) {
        return false;
    }
    return true;
}

public function addDeliveryAddress(DeliveryAddress $deliveryAddress) {


    $stmt = $this->pdo->prepare("INSERT INTO delivery_address(street, street_number, city, zip_code, order_table_id) VALUES 
    (:street, :street_number, :city, :zip_code, :order_table_id)");


    try {
        if(!$stmt->execute([
            'street' => $deliveryAddress->getStreet(),
            'street_number' => $deliveryAddress->getStreetNumber(),
            'city' => $deliveryAddress->getCity(),
            'zip_code' => $deliveryAddress->getZipCode(),
            'order_table_id' => $deliveryAddress->getOrderId()
        ])) {
            throw new Exception("chyba v metodě addOrderItem");
        }
        return true;
    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }




}


public function getAllOrders() {

        
    $stmt = $this->pdo->prepare("SELECT ot.id, ot.date, ot.price, u.email, guest_email FROM order_table ot LEFT JOIN user u ON ot.user_id = u.id ORDER BY ot.date DESC");
    try {
        if($stmt->execute()) {
           $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $orders;
        }
        else {
            throw new Exception("Nepovedlo se ziskat data objednavek z databaze pomoci getOrders");
        }

    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }


}
public function getOrdersByUserId($userId) {

        
    $stmt = $this->pdo->prepare("SELECT ot.id, ot.date, ot.price, u.email, guest_email FROM order_table ot LEFT JOIN user u ON ot.user_id = u.id 
    WHERE ot.user_id = :user_id 
    ORDER BY ot.date DESC");
    try {
        if($stmt->execute(['user_id' => $userId])) {
           $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $orders;
        }
        else {
            throw new Exception("Nepovedlo se ziskat data objednavek z databaze pomoci getOrders");
        }

    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }


}


public function checkPermissionToViewOrderDetails($orderId) {
    $userId = $_SESSION["userId"];

    $stmt = $this->pdo->prepare("SELECT ot.id FROM order_table ot JOIN user u ON ot.user_id = u.id 
    WHERE ot.user_id = :user_id AND ot.id = :order_id");
    try {
        if($stmt->execute([':user_id' => $userId,
        'order_id' => $orderId])) {
            $permission = $stmt->fetch(PDO::FETCH_ASSOC);
           return $permission;
        }
        else {
            throw new Exception("Nepovedlo se ziskat data objednavek z databaze pomoci checkPermissionToViewOrderDetails");
        }

    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }



}



public function getOrderDetails($orderId) {
    
    $stmt = $this->pdo->prepare("SELECT da.street, da.street_number, da.city, da.zip_code, ot.date, ot.price, ot.payment_method, ot.guest_name, ot.guest_surname, ot.guest_email ,u.name, u.surname, u.email FROM delivery_address da JOIN order_table ot ON da.order_table_id = ot.id LEFT JOIN user u ON ot.user_id = u.id WHERE ot.id = :order_id");
    try {
        if($stmt->execute(['order_id' => $orderId])) {
           $orderData = $stmt->fetch(PDO::FETCH_ASSOC);
           return $orderData;
        }
        else {
            throw new Exception("Nepovedlo se ziskat data objednavek z databaze pomoci getOrders");
        }

    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }

}

public function getOrderItemsByOrderId($orderId) {
    $stmt = $this->pdo->prepare("SELECT oi.price AS order_item_price, p.name, p.description, p.price, p.image_name FROM order_item oi JOIN product p ON oi.product_id = p.id WHERE oi.order_table_id = :order_id");
    try {
        if($stmt->execute([':order_id' => $orderId])) {
           $orderData = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $orderData;
        }
        else {
            throw new Exception("Nepovedlo se ziskat data objednavek z databaze pomoci getOrders");
        }

    }
    catch(Exception $e) {
        ErrorLog::logError($e);
        return null;
    }


}




}
?>