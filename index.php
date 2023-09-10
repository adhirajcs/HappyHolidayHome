<?php

# database
include("inc/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HappyHolidayHome - Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <script>
        function validateDates() {
            const checkInDate = new Date(document.forms["searchForm"]["checkIn"].value);
            const checkOutDate = new Date(document.forms["searchForm"]["checkOut"].value);

            if (checkInDate > checkOutDate) {
                alert("Check-in date cannot be greater than the check-out date.");
                return false;
            }
            
            return true;
        }
    </script>
</head>

<body>
    
    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>
    
    <div class="container">
        <form name="searchForm" action="search.php" method="GET" class="form" onsubmit="return validateDates();">
            <label>Location:</label>
            <input type="text" name="location" placeholder="Your Location" required>
            <label>Check-In:</label>
            <input type="date" name="checkIn" required>
            <label>Check-Out:</label>
            <input type="date" name="checkOut" required>
            
            <button type="submit" name="search" class="btn btn-success">Search</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
    
    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>
