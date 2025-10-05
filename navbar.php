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
    <a href="#" class="navbar-logo">MyApp</a>
    <div class="navbar-menu">
        <a href="/accommodations_dashboard.php">Accommodations Dashboards</a>
        <?php if($user_role == 1): ?>
        <a href="/accommodation_management.php">Accommodation Management</a>
        <?php endif; ?>
    </div>
</nav>
