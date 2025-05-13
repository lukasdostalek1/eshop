<?php


class Category implements JsonSerializable  {
    private ?int $id;
    private string $name;
    private int $user_id;

    public function __construct(string $name, int $user_id,int $id = null) {
    $this->id = $id;
    $this->name = $name;
    $this->user_id = $user_id;
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

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function jsonSerialize(): mixed {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "user_id" => $this->user_id
        ];
    }

}