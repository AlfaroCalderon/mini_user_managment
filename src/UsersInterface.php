<?php 
namespace Ralfaro\UserManagement;

interface UsersInterface{
    public function getId(): int;
    public function setId(int $id): void;

    public function getFirstname(): string;
    public function setFirstname(string $firstname): void;

    public function getLastname(): string;
    public function setLastname(string $lastname): void;

    public function getEmail(): string;
    public function setEmail(string $email): void;

    public function getAge(): int;
    public function setAge(int $age): void;

    public function getBirthday(): string;
    public function setBirthday(string $birthdate): void;
    
    public function getPassword(): string;
    public function setPassword(string $password): void;

    public function getUserRole(): string;
    public function setUserRole(string $userRole): void;

}



?>