<?php

# database
include("../inc/db.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Get the admin's name from the session
$adminName = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 

    <link rel="icon" type="image/x-icon" href="assets/img/admin_logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_signup_login.css">

</head>
<body>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="page1.php">
                                Page 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="page2.php">
                                Page 2
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1>Welcome, <?php echo $adminName; ?></h1>
                </div>

                <!-- Add your content for the admin panel here -->
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="navbar navbar-expand-lg navbar-dark bg-primary footer" style="position: absolute; bottom: 0; width: 100%;">
        <div class="container d-flex flex-column align-items-center">
            <div class="footer-info text-center">
                <p style="font-weight: bold; margin: auto;">HappyHolidayHome
                    <br>Made with ❤️ by Adhiraj Saha</p>
                <br>
                <p>Connect with me on:</p>
                <a href="https://www.linkedin.com/in/adhirajsaha" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-2x fa-linkedin" style="color: #ffffff;"></i>
                </a>
                &nbsp;
                <a href="https://github.com/adhirajcs" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-2x fa-github" style="color: #ffffff;"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for theme toggle -->
    <script src="assets/js/admin_signup_login.js"></script>
    <script src="assets/js/header_footer.js"></script>

</body>
</html>
