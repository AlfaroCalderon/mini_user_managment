<?php
session_start();
require __DIR__.'/vendor/autoload.php';
use Ralfaro\UserManagement\AccommodationsManagement;
$accommodations = new AccommodationsManagement();
$allAccommodations = $accommodations->showAllAvailableAccommodations();
// Simulate favorites (in real app, fetch from DB/user session)
$favorites = isset($_POST['favorites']) ? $_POST['favorites'] : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['user_id'];
    $favorite = $_POST['favorite'] ?? [];
    $remove_favorite = $_POST['remove_favorite'] ?? null;

    //add favorites
    if(!empty($favorite)){
       foreach($favorite as $fav){
           $answer = $accommodations->addAccommodationToUser($user_id, $fav);
       } 
    }

    //remove favorite
    if($remove_favorite){
        $answer = $accommodations->removeAccommodationFromUser($user_id, $remove_favorite);
    }
}

$likedAccommodations = $accommodations->showAllAccommodationsPerUser($_SESSION['user']['user_id']);
$checkedids = [];
foreach($likedAccommodations as $fav){
    $checkedids[] = $fav['accomodation_id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accommodations Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard_styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Accommodations Dashboard</h1>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="accommodations-grid">
                <?php foreach ($allAccommodations as $acc): ?>
                    <div class="accommodation-card">
                        <img src="<?php echo htmlspecialchars($acc['img_url']); ?>" alt="<?php echo htmlspecialchars($acc['name']); ?>" class="accommodation-image">
                        <input type="hidden" name="accommodation_id" value="<?php echo $acc['accommodation_id']; ?>">
                        <div class="accommodation-details">
                            <div class="accommodation-name"><?php echo htmlspecialchars($acc['name']); ?></div>
                            <div class="accommodation-type"><?php echo htmlspecialchars($acc['type']); ?></div>
                            <div class="accommodation-description"><?php echo htmlspecialchars($acc['description']); ?></div>
                            <div class="accommodation-address"><?php echo htmlspecialchars($acc['address']); ?></div>
                            <div class="accommodation-capacity">Capacity: <?php echo (int)$acc['capacity']; ?></div>
                            <div class="accommodation-price">$<?php echo number_format($acc['price_per_night'], 2); ?> / night</div>
                            <div class="favorite-checkbox">
                                <?php if (!in_array($acc['accommodation_id'], $checkedids)): ?>
                                    <input type="checkbox" name="favorite[]" value="<?php echo $acc['accommodation_id']; ?>">
                                    <label>Add to favorites</label>
                                <?php else: ?>
                                    <span style="color: red; font-size: 1.5em;">&#10084;</span>
                                    <label>Already in favorites</label>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="save-btn">Save Favorites</button>
        </form>

        <div class="favorites-section">
            <h2>Your Favorites</h2>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <ul class="favorite-list">
               <?php
               if(empty($likedAccommodations)){
                echo '<p style="text-align: center; color: #555;">No favorite accommodations selected yet.</p>';
               }
               foreach ($likedAccommodations as $fav): ?>
                <li class="favorite-item">
                    <img src="<?php echo htmlspecialchars($fav['img_url']); ?>" alt="<?php echo htmlspecialchars($fav['accomodation_name']); ?>" class="favorite-image">
                    <div class="favorite-details">
                        <div class="favorite-name"><?php echo htmlspecialchars($fav['accomodation_name']); ?></div>
                        <div class="favorite-type"><?php echo htmlspecialchars($fav['type']); ?></div>
                        <div class="favorite-price">$<?php echo number_format($fav['price_per_night'], 2); ?> / night</div>
                    </div>
                    <button type="submit"  name="remove_favorite" value="<?php echo $fav['accomodation_id']; ?>" class="remove-btn">Remove</button>
                </li>
            <?php endforeach; ?>
            </ul>
            </form>
        </div>
    </div>
</body>
</html>