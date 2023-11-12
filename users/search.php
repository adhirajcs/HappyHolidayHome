<?php
# database
include("../inc/db.php");

// Initialize variables
$searchError = "";
$searchResults = array();

// Check if the form data has been submitted
if (isset($_GET['location'], $_GET['checkIn'], $_GET['checkOut'])) {
    $location = $_GET['location'];
    $checkIn = $_GET['checkIn'];
    $checkOut = $_GET['checkOut'];

    // Construct the query
    $query = "SELECT * FROM holiday_homes WHERE location LIKE '%$location%' AND availability_status = 'available'";
    $result = $con->query($query);

    if (!$result) {
        $searchError = "Error fetching results: " . $con->error;
    } else {
        // Fetch search results
        while ($row = $result->fetch_assoc()) {
            // Check availability for the given check-in and check-out dates
            $homeId = $row['home_id'];
            $availabilityQuery = "SELECT COUNT(*) as count FROM reservations WHERE home_id = $homeId AND check_in_date <= '$checkOut' AND check_out_date >= '$checkIn'";
            $availabilityResult = $con->query($availabilityQuery);

            if ($availabilityResult) {
                $availabilityRow = $availabilityResult->fetch_assoc();
                if ($availabilityRow['count'] == 0) {
                    // Home is available for the selected dates
                    $searchResults[] = $row;
                }
                $availabilityResult->free();
            } else {
                $searchError = "Error checking availability: " . $con->error;
                break;
            }
        }
        $result->free();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Results - HappyHolidayHome</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="../assets/css/searches.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>
    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <?php
        if (!empty($searchError)) {
            echo "<p class='error'>$searchError</p>";
        } elseif (!empty($searchResults)) {
            foreach ($searchResults as $row) {
                // Display information about each holiday home
                echo "<div class='holiday-home'>";
                echo "<img src='{$row['image_path']}' alt='{$row['name']}' class='home-image'>";
                echo "<div class='holiday-details'>";
                echo "<h2>{$row['name']}</h2>";
                echo "<p class='label'>Location:</p>";
                echo "<p>{$row['location']}</p>";
                echo "<p class='label'>Price:</p>";
                echo "<p>₹{$row['price']}</p>";
                echo "<p class='label'>Rating:</p>";
                echo "<p>{$row['rating']}</p>";
                echo "<div class='buttons'>";
                echo "<a href='reserve.php?home_id={$row['home_id']}&checkIn=$checkIn&checkOut=$checkOut' class='btn'>Book Now</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>
</body>

</html>