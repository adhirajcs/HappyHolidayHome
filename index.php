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
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="assets/img/logo.jpg" alt="Logo" style="width: 30px; height: auto;">
                </a>
            </div>
            <ul class="nav-links">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
                    <!-- Display this for logged-in users -->
                    <li><a href="index.php">Home</a></li>
                    <li><a href="users/about.php">About</a></li>
                    <li><a href="users/contact.php">Contact Us</a></li>
                    <li class="dropdown">
                        <span class="profile-info">
                            <img src="assets/img/user.png" alt="Profile Icon" class="profile-icon">
                            <?php echo $_SESSION['name']; ?>
                        </span>
                        <ul class="dropdown-content">
                            <li><a href="users/profile.php">My Profile</a></li>
                            <li><a href="users/reservations.php">My Reservations</a></li>
                            <li><a href="users/logout.php">Logout</a></li>
                        </ul>
                    </li>

                <?php else : ?>
                    <!-- Display this for unregistered users -->
                    <li><a href="index.php">Home</a></li>
                    <li><a href="users/about.php">About</a></li>
                    <li><a href="users/contact.php">Contact Us</a></li>
                    <li><a href="users/login.php">Login</a></li>
                    <li><a href="users/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>


    <div class="container">
        <form name="searchForm" action="users/search.php" method="GET" class="form" onsubmit="return validateDates();">
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
    <footer class="footer">
        <div class="footer-content">
            <a href="index.php">
                <img src="assets/img/logo.jpg" alt="Logo" style="width: 100px; height: auto;">
            </a>
            <div class="footer-links">
                <a href="index.php">Home</a>
                <a href="users/about.php">About Us</a>
                <a href="users/contact.php">Contact Us</a>
            </div>
        </div>
        <div class="footer-info">
            <p>HappyHolidayHome</p>
            <br>
            <p>Made with ❤️ by Adhiraj Saha</p>
            <br>
            <p>Connect with me on:</p>
            <br>
            <a href="https://www.linkedin.com/in/adhirajsaha" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-2x fa-linkedin" style="color: #ffffff;"></i>
            </a>
            &nbsp;
            <a href="https://github.com/adhirajcs" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-2x fa-github" style="color: #ffffff;"></i>
            </a>
        </div>
    </footer>
</body>

</html>