<?php 
namespace Ralfaro\UserManagement;

use Ralfaro\UserManagement\Conn;

class UserManagment{
   private $conn;
   
   public function __construct(){
    $this->conn = new Conn();
   }
}

?>