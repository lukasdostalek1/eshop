<?php

class Product implements JsonSerializable {
    private ?int $id;
    private string $name;
    private string $description;
    private int $price;
    private string $image_file_name;
    private int $user_id;
    private int $category_id;


    public function __construct(string $name, string $description, int $price, string $image_file_name, int $user_id, int $category_id, int $id = null) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image_file_name = $image_file_name;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName() :string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getDescription() :string {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice(int $price) {
        $this->price = $price;
    }

    public function getImageFileName() {
        return $this->image_file_name;
    }

    public function setImageFileName(string $image_file_name) {
     $this->image_file_name = $image_file_name;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getCategoryId() : int {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id) {
        $this->category_id = $category_id;
    }

    public function jsonSerialize(): mixed {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "image_name" => $this->image_file_name,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            "id" => $this->id
        ];
    }

}