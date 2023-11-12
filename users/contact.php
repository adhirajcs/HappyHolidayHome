<?php

# database
include("../inc/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HappyHolidayHome - Contact Us</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>

    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <h1>Contact Us</h1>
        <p class="contact-info">Have questions or feedback? Reach out to us using the contact details below:</p>
        <ul class="contact-list">
            <li>Email: info@happyholidayhome.com</li>
            <li>Phone: +1 (123) 456-7890</li>
            <li>Address: 123 Vacation Street, Paradise City</li>
        </ul>
        <p>We'd love to hear from you!</p>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>
</body>

</html>