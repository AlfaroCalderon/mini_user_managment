<?php 
namespace Ralfaro\UserManagement;
use Ralfaro\UserManagement\Conn;
session_start();

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

    public function addUser(UsersInterface $user){
      $statement = $this->conn->getConn()->prepare("INSERT INTO users (firstname, lastname, email, age, birthdate, password, user_role) VALUES (:firstname, :lastname, :email, :age, :birthdate, :password, :user_role); ");
      $statement->execute([
         ":firstname" => $user->getFirstname(),
         ":lastname" => $user->getLastname(),
         ":email" => $user->getEmail(),
         ":age" => $user->getAge(),
         ":birthdate" => $user->getBirthday(),
         ":password" => $user->getPassword(),
         ":user_role" => $user->getUserRole()
      ]);

      if($statement->rowCount() > 0){
          $user_data = $this->showUser($user->getEmail(), $user->getPassword());

          echo $user_data;
          
          $_SESSION['firstname'] = $user->getFirstname();
          $_SESSION['lastname'] = $user->getLastname();
          $_SESSION['email'] = $user->getEmail();
          $_SESSION['age'] = $user->getAge();
          $_SESSION['birthdate'] = $user->getBirthday();
          $_SESSION['user_role'] = $user->getUserRole();
         return 'New user has been created';
      }else{
         return 'The user was not created';
      }
   }
}

?>