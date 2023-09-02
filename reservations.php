<?php


# database
include("inc/db.php");


// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Fetch reservations for the logged-in user
$userId = $_SESSION['user_id'];
$query = "SELECT reservations.*, holiday_homes.name, holiday_homes.image_path 
          FROM reservations 
          INNER JOIN holiday_homes ON reservations.home_id = holiday_homes.home_id 
          WHERE reservations.user_id = $userId";
$result = mysqli_query($conn, $query);

$reservations = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reserve - HappyHolidayHome</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/reservation.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>

    <div class="container">
    <h1 style="margin-top: 50px;">My Reservations</h1>
    <?php
    if (!empty($reservations)) {
        echo "<ul class='reservation-list'>";
        foreach ($reservations as $reservation) {
            echo "<li class='reservation-item'>";
            echo "<img src='{$reservation['image_path']}' alt='{$reservation['name']}' class='home-image'>";
            echo "<div class='reservation-details'>";
            echo "<p><strong>Home:</strong> {$reservation['name']}</p>";
            echo "<p><strong>Check-in:</strong> {$reservation['check_in_date']}</p>";
            echo "<p><strong>Check-out:</strong> {$reservation['check_out_date']}</p>";
            echo "<p><strong>Total Price:</strong> ₹{$reservation['total_price']}</p>";
            echo "<form method='post' action='cancel_booking.php'>";
            echo "<input type='hidden' name='reservation_id' value='{$reservation['reservation_id']}'>";
            echo "<button type='submit' class='cancel-button' name='cancel_booking'>Cancel Booking</button>";
            echo "</form>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No reservations found.</p>";
    }
    ?>
</div>

    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>
</html>
