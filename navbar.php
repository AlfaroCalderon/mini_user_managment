<?php 
$user_identifier = $_SESSION['user']['user_id'];
$user_role = $_SESSION['user']['user_role'];

if(empty($user_identifier)){
    header('Location: index.php');
    exit();
}

?>
<link rel="stylesheet" href="css/navbar.css">
<nav class="navbar">
    <a href="dashboard.php" class="navbar-logo">Accommodations 🏨</a>
    <div class="navbar-menu">
        <a href="dashboard.php">Accommodations Dashboards</a>
        <?php if($user_role == 1): ?>
        <a href="accommodation_management.php">Accommodation Management</a>
        <?php endif; ?>
        <a href="signout.php" class="signout">Sign Out</a>
    </div>
</nav>
