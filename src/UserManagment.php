<?php 
namespace Ralfaro\UserManagement;
use Ralfaro\UserManagement\Conn;

class UserManagment{
   private $conn;
   
   public function __construct(){
    $this->conn = new Conn();
   }

   public function showUser($email, $password){
      $statement = $this->conn->getConn()->prepare("SELECT * FROM users WHERE email = :email AND password = :password ;");
      $statement->execute([
         ":email" => $email,
         ":password" => $password
      ]);

        $answer = $statement->fetch(mode: \PDO::FETCH_ASSOC);
        return $answer;
   }
   public function validateEmail($email){
      $statement = $this->conn->getConn()->prepare("SELECT * FROM users WHERE email = :email;");
      $statement->execute([
         ":email" => $email
      ]);

        $answer = $statement->fetch(mode: \PDO::FETCH_ASSOC);
        return $answer;
   }

    public function addUser(UsersInterface $user){

      $email = $this->validateEmail($user->getEmail());
      if($email){
         return 'email_exists';
      }

      $statement = $this->conn->getConn()->prepare("INSERT INTO users (firstname, lastname, email, age, birthdate, password, user_role) VALUES (:firstname, :lastname, :email, :age, :birthdate, :password, :user_role); ");
      $statement->execute([
         ":firstname" => $user->getFirstname(),
         ":lastname" => $user->getLastname(),
         ":email" => $user->getEmail(),
         ":age" => $user->getAge(),
         ":birthdate" => $user->getBirthday(),
         ":password" => $user->getPassword(),
         ":user_role" => 2
      ]);

      if($statement->rowCount() > 0){
         return 'true';
      }else{
         return 'false';
      }
   }
}

?>