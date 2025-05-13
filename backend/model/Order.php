<?php
require_once "OrderItem.php";

class Order implements JsonSerializable {
    private ?int $id;
    private string $date;
    private ?int $user_id;
    private array $order_items = [];
    private int $price = 0;
    private int $payment_method;
    private ?string $guest_name;
    private ?string $guest_surname;
    private ?string $guest_email;

    public function __construct(int $payment_method, ?int $user_id = null, ?string $guest_name,?string $guest_surname ,?string $guest_email, ?int $id = null) {
        $this->date = date('Y-m-d H:i:s');
        $this->id = $id;
        $this->user_id = $user_id;
        $this->payment_method = $payment_method;
        $this->guest_name = $guest_name;
        $this->guest_surname = $guest_surname;
        $this->guest_email = $guest_email;
    }

    private function addUpThePrice($priceOfItem) {
        $this->price += $priceOfItem;
    }


    public function addOrderItem(OrderItem $orderItem): void {
        $this->order_items[] = $orderItem;
        $this->addUpThePrice($orderItem->getItemPrice());
    }

    public function getPrice() {
        return $this->price;
    }

    public function getPaymentMethod() {
        return $this->payment_method;
    }

    public function getOrderItems() {
        return $this->order_items;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function getUserId(): ?int {
        return $this->user_id;
    }

    public function getGuestName() {
        return $this->guest_name;
    }
    public function getGuestSurname() {
        return $this->guest_surname;
    }
    public function getGuestEmail() {
        return $this->guest_email;
    }

    // SETTERY
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function setOrderItems(array $order_items): void {
        $this->order_items = $order_items;
    }

    // JSON SERIALIZACE
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'user_id' => $this->user_id,
            'order_items' => $this->order_items,
            'guest_name' => $this->guest_name,
            'guest_surname' => $this->guest_surname,
            'guest_email' => $this->guest_email,
            'payment_method' => $this->payment_method,
            'price' => $this->price
        ];
    }
}
