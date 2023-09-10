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

    <link rel="icon" type="image/x-icon" href="assets/img/admin_logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_panel.css">
</head>
<body>
    

    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" class="btn btn-primary">Toggle Sidebar</button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content">
            <h2>Sidebar Content</h2>
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
    </div>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    

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
                            <h5 class="card-title">Users</h5>
                            <p class="card-text"><?php echo $userCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Holiday Homes</h5>
                            <p class="card-text"><?php echo $holidayHomeCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reserved Homes</h5>
                            <p class="card-text"><?php echo $reservedHomeCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include("inc/admin_footer.php"); ?>

    <!-- Custom JavaScript for theme toggle -->
    <script src="assets/js/admin_panel.js"></script>
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
