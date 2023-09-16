<?php
# Include the database connection file
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Fetch user data from the database
$sqlUsers = "SELECT user_id, name, email, phone FROM users";
$resultUsers = $con->query($sqlUsers);

# Check if there are any users
if ($resultUsers->num_rows > 0) {
    $users = $resultUsers->fetch_all(MYSQLI_ASSOC);
} else {
    // No users found
    $users = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Users</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/img/admin_logo.jpg">
    <link rel="stylesheet" href="assets/css/view_users.css">
</head>
<body>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" class="btn btn-primary">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <div class="d-flex justify-content-end">
                        <a class="navbar-brand" href="../index.php">
                            <img src="assets/img/admin_logo.jpg" alt="HappyHolidayHome" class="website-icon" style="max-width: 150px;">
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_dashboard.php">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_holidayhomes.php">
                        Holiday Homes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_users.php">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_reservations.php">
                        Reservations
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">

            <!-- Display Users in a Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <!-- <?php include("inc/admin_footer.php"); ?> -->

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
