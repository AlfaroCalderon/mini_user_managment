<?php 

namespace Ralfaro\UserManagement;

class Conn{
    public function getConn() {
        try {
        $host = 'localhost';
        $db = 'users_db';
        $user = 'root';
        $pass = '';

        return new \PDO("mysql:host=$host;dbname=$db", $user, $pass);
        
    } catch (\Throwable $th) {         
        echo "Error: " . $th->getMessage();
        return null;
    }     
    }
}




?>