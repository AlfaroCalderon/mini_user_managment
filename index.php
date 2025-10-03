<?php 
session_start();
require __DIR__.'/vendor/autoload.php';
use Ralfaro\UserManagement\Users;
use Ralfaro\UserManagement\UserManagment;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
 $email = $_POST['email'];
 $password = $_POST['password'];

 if(!empty($email) && !empty($password)){
    $management = new UserManagment();
    $user = $management->showUser($email, $password);

    if($user){
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    }else{
        $error_message = "Invalid email or password";
    }
 }
  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accommodation Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🏨 Accommodation Portal</h1>
            <p>Access your booking dashboard</p>
        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="login" class="btn btn-primary">
                Sign In
            </button>
            <?php
                if(isset($error_message)){
                    echo '<div class="error-message" style="color: #e74c3c; background-color: #fadbd8; border: 1px solid #e74c3c; padding: 10px; margin: 10px 0; border-radius: 4px; text-align: center;">'.$error_message.'</div>';
                }
            ?>
        </form>
        
        <hr class="divider">
        
        <button type="button" class="btn btn-secondary">
            Create New Account
        </button>
        
</body>
</html>