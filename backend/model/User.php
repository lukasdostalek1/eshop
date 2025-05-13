<?php


class User implements JsonSerializable{
   private string $name;
   private string $surname;
   private string $email;
   private string $password;
   private int $role;
   private ?int $id;

   public function __construct(string $name, string $surname, string $email, string $password, int $role = 0, int $id = null) {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
    $this->password =  $password;
    $this->role = $role;
   }

   public function setId(int $id) {
    $this->id = $id;
   }
   public function getId(): int {
    return $this->id;
   }

   public function setRole(int $role) {
      $this->role = $role;
     }



     public function getRole(): int {
      return $this->role;
     }


   public function getName() :string {
    return $this->name;
   }

   public function setName(string $name) {
    $this->name = $name;
   }

   public function getSurname() :string {
    return $this->surname;
   }

   public function setSurname(string $surname) {
    $this->surname = $surname;
   }



   public function getEmail() :string {
    return $this->email;
   }

   public function setEmail(string $email) {
    $this->email = $email;
   }

   
   public function getPassword() :string {
    return $this->password;
   }

   public function setPassword(string $password) {
    $this->password = $password;
   }


   public function jsonSerialize(): mixed {
      return [
          "name" => $this->name,
          "surname" => $this->surname,
          "email" => $this->email,
          "password" => $this->password,
          "role" => $this->role,
          "id" => $this->id
      ];
  }
}