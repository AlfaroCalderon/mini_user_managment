<?php 

namespace Ralfaro\UserManagement;

class Users implements UsersInterface{

    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $age;
    private $password;
    private $birthday;
    private $role;


        public function setId(int $id): void{
            $this->id = $id;
        }
        public function getId(): int{
            return $this->id; 
        }

        public function setFirstname(string $firstname): void{
            $this->firstname = $firstname;
        }
        public function getFirstname(): string{
            return $this->firstname;
        }

        public function setLastname(string $lastname): void{
            $this->lastname = $lastname;
        }
        public function getLastname(): string{
            return $this->lastname;
        }

        public function setEmail(string $email): void{
            $this->email = $email;
        }
        public function getEmail(): string{
            return $this->email;
        }

        public function setAge(int $age): void{
            $this->age = $age;
        }
        public function getAge(): int{
            return $this->age;
        }

        public function setBirthday(string $birthday): void{
            $this->birthday = $birthday;
        }
        public function getBirthday(): string{
            return $this->birthday;
        }

        public function setPassword(string $password): void{
            $this->password = $password;
        }

        public function getPassword(): string{
            return $this->password;
        }

        public function setUserRole(string $role): void{
            $this->role = $role;
        }
        public function getUserRole(): string{
            return $this->role;
        }


}


?>