<?php

class DeliveryAddress implements JsonSerializable {
    private ?int $id;
    private string $street;
    private string $street_number;
    private string $city;
    private string $zip_code;
    private Order $order;

    public function __construct(string $street, string $street_number, string $city, string $zip_code, Order $order, ?int $id = null) {
        $this->street = $street;
        $this->street_number = $street_number;
        $this->city = $city;
        $this->zip_code = $zip_code;
        $this->id = $id;
        $this->order = $order;
        }

    public function getOrderId() {
        return $this->order->getId();
    }

    public function getStreet(): string {
        return $this->street;
    }

    public function getStreetNumber(): string {
        return $this->street_number;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getZipCode(): string {
        return $this->zip_code;
    }




    public function setStreet(string $street): void {
        $this->street = $street;
    }

    public function setStreetNumber(string $street_number): void {
        $this->street_number = $street_number;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function setZipCode(string $zip_code): void {
        $this->zip_code = $zip_code;
    }
    // JSON serializace
    public function jsonSerialize(): array {
        return [
            'street' => $this->street,
            'street_number' => $this->street_number,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'order_table_id' => $this->order_table_id
        ];
    }
}
