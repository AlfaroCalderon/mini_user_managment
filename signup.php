<?php 
session_start();
require __DIR__.'/vendor/autoload.php';
use Ralfaro\UserManagement\Users;
use Ralfaro\UserManagement\UserManagment;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
 $firstname = $_POST['firstname'];
 $lastname = $_POST['lastname'];
 $age = $_POST['age'];
 $birthdate = $_POST['birthdate'];
 $email = $_POST['email'];
 $password = $_POST['password'];


 if(!empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($age) && !empty($birthdate)){
    $management = new UserManagment();
    $user = new Users();
    $user->setFirstname($firstname);
    $user->setLastname($lastname);
    $user->setEmail($email);
    $user->setAge($age);
    $user->setBirthday($birthdate);
    $user->setPassword($password);
    $result = $management->addUser($user);

    if($result === 'email_exists'){
        $error_message = "Email already in use. Please use a different email.";
    }else{
        if($result){
            header('Location: index.php');
            exit();
        }else{
            $error_message = "Error creating user. Please try again.";
        }
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
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" min="0" max="150" step="1" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="signup" class="btn btn-primary">
                Sign up
            </button>
             <?php
                if(isset($error_message)){
                    echo '<div class="error-message" style="color: #e74c3c; background-color: #fadbd8; border: 1px solid #e74c3c; padding: 10px; margin: 10px 0; border-radius: 4px; text-align: center;">'.$error_message.'</div>';
                }
            ?>
        </form>
        
        <hr class="divider">

        <a href="index.php" class="btn btn-secondary">
            Go back 
        </a>

</body>
</html>