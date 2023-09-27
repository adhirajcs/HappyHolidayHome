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

// Fetch counts from the database
$sqlUserCount = "SELECT COUNT(user_id) AS user_count FROM users";
$resultUserCount = $con->query($sqlUserCount);
$userCount = $resultUserCount->fetch_assoc()['user_count'];

$sqlHolidayHomeCount = "SELECT COUNT(home_id) AS home_count FROM holiday_homes";
$resultHolidayHomeCount = $con->query($sqlHolidayHomeCount);
$holidayHomeCount = $resultHolidayHomeCount->fetch_assoc()['home_count'];

$sqlReservedHomeCount = "SELECT COUNT(reservation_id) AS reserved_count FROM reservations";
$resultReservedHomeCount = $con->query($sqlReservedHomeCount);
$reservedHomeCount = $resultReservedHomeCount->fetch_assoc()['reserved_count'];
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
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_dashboard.css">
</head>
<body>
    
    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>


    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" class="btn btn-primary">
    <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <?php include("inc/admin_side_bar.php"); ?>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1>Welcome, <?php echo $adminName; ?></h1>
            </div>

            <!-- Display counts for users, total holiday homes, and reserved homes -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-users fa-5x"></i>
                            <h5 class="card-title">Total no. of Users</h5>
                            <p class="card-text"><?php echo $userCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-home fa-5x"></i>
                            <h5 class="card-title">Total no. of Holiday Homes</h5>
                            <p class="card-text"><?php echo $holidayHomeCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-calendar-check fa-5x"></i>
                            <h5 class="card-title">Total no. of Reserved Homes</h5>
                            <p class="card-text"><?php echo $reservedHomeCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- Custom JavaScript for theme toggle -->
    <script src="assets/js/dark_mode.js"></script>
    <script src="assets/js/header_footer.js"></script>

    <!-- JavaScript to toggle the sidebar -->
    <script>
        const toggleSidebarBtn = document.getElementById("toggle-sidebar");
        const sidebar = document.getElementById("sidebar");

        toggleSidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("show");
        });
    </script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
