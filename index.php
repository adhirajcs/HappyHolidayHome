<?php

# database
include("inc/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHolidayHome - Home</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    
    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>
    
    <div class="container">
        <form action="search.php" method="GET" class="form">
            <label>Location:</label>
            <input type="text" name="location" placeholder="Your Location" required>
            <label>Check-In:</label>
            <input type="date" name="checkIn" required>
            <label>Check-Out:</label>
            <input type="date" name="checkOut" required>
            
            <button type="submit" name="search" class="btn btn-success">Search</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </form>

        <?php
        if (isset($searchError)) {
            echo "<p class='error'>$searchError</p>";
        }
        ?>
    </div>
    
    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>