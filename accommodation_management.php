<?php
session_start();
require __DIR__.'/vendor/autoload.php';
use Ralfaro\UserManagement\AccommodationsManagement;
use  Ralfaro\UserManagement\Accommodations;
$accommodationsManagement = new AccommodationsManagement();
$accommodations = new Accommodations();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    $description = $_POST['description'] ?? '';
    $img_url = $_POST['img_url'] ?? '';
    $address = $_POST['address'] ?? '';
    $price_per_night = $_POST['price_per_night'] ?? 0;
    $capacity = $_POST['capacity'] ?? 1;

    // Basic validation
    if($name && $type && $description && $address && is_numeric($price_per_night) && is_numeric($capacity)){
        $accommodations->setName($name);
        $accommodations->setType($type);
        $accommodations->setDescription($description);
        $accommodations->setImgUrl($img_url);
        $accommodations->setAddress($address);
        $accommodations->setPricePerNight((float)$price_per_night);
        $accommodations->setCapacity((int)$capacity);
        $accommodations->setAvailable(true);

        $answer = $accommodationsManagement->createAccommodation($accommodations);
        if($answer === 'true'){
            header('Location: dashboard.php');
            exit();
        }else{
            echo "<p style='color:red;'>Error adding accommodation. Please try again.</p>";
        }
    }
}

require 'navbar.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Accommodation</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/accommodation_management.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Accommodation</h2>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="name">Accommodation Name</label>
                <input type="text" id="name" name="name" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" id="type" name="type" required maxlength="100">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required maxlength="1000"></textarea>
            </div>
            <div class="form-group">
                <label for="img_url">Image URL</label>
                <input type="url" id="img_url" name="img_url" maxlength="500" placeholder="https://example.com/image.jpg">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required maxlength="500">
            </div>
            <div class="form-group">
                <label for="price_per_night">Price per Night ($)</label>
                <input type="number" id="price_per_night" name="price_per_night" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" id="capacity" name="capacity" required min="1" step="1">
            </div>
            <button type="submit" class="submit-btn">Add Accommodation</button>
        </form>
    </div>
</body>
</html>