<?php
# Include the database connection file
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Fetch reservation data from the database
$sqlReservations = "SELECT * FROM reservations";
$resultReservations = $con->query($sqlReservations);

# Check if there are any reservations
if ($resultReservations->num_rows > 0) {
    $reservations = $resultReservations->fetch_all(MYSQLI_ASSOC);
} else {
    // No reservations found
    $reservations = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Reservations</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/img/admin_logo.jpg">
    <link rel="stylesheet" href="assets/css/view_reservations.css">
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

            <!-- Display Reservations in a Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Home ID</th>
                            <th>Check-In Date</th>
                            <th>Check-Out Date</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation) : ?>
                            <tr>
                                <td><?php echo $reservation['reservation_id']; ?></td>
                                <td><?php echo $reservation['user_id']; ?></td>
                                <td><?php echo $reservation['home_id']; ?></td>
                                <td><?php echo $reservation['check_in_date']; ?></td>
                                <td><?php echo $reservation['check_out_date']; ?></td>
                                <td>₹<?php echo $reservation['total_price']; ?></td>
                                <td>
                                    <!-- Button to trigger the edit modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $reservation['reservation_id']; ?>">
                                        Edit
                                    </button>
                                    <a href="delete_reservation.php?id=<?php echo $reservation['reservation_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modals for editing reservations -->
    <?php foreach ($reservations as $reservation) : ?>
        <div class="modal fade <?php echo isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'dark-mode' : ''; ?>" id="editModal_<?php echo $reservation['reservation_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel_<?php echo $reservation['reservation_id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_<?php echo $reservation['reservation_id']; ?>">Edit Reservation No. <?php echo $reservation['reservation_id']; ?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Form -->
                        <form method="POST" action="update_reservation.php">
                            <!-- Hidden input to pass reservation_id to update_reservation.php -->
                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                            
                            <!-- User ID -->
                            <div class="mb-3">
                                <label for="user_id_<?php echo $reservation['reservation_id']; ?>" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="user_id_<?php echo $reservation['reservation_id']; ?>" name="user_id" value="<?php echo $reservation['user_id']; ?>">
                            </div>
                            
                            <!-- Home ID -->
                            <div class="mb-3">
                                <label for="home_id_<?php echo $reservation['reservation_id']; ?>" class="form-label">Home ID</label>
                                <input type="text" class="form-control" id="home_id_<?php echo $reservation['reservation_id']; ?>" name="home_id" value="<?php echo $reservation['home_id']; ?>">
                            </div>
                            
                            <!-- Check-In Date -->
                            <div class="mb-3">
                                <label for="check_in_date_<?php echo $reservation['reservation_id']; ?>" class="form-label">Check-In Date</label>
                                <input type="date" class="form-control" id="check_in_date_<?php echo $reservation['reservation_id']; ?>" name="check_in_date" value="<?php echo $reservation['check_in_date']; ?>">
                            </div>
                            
                            <!-- Check-Out Date -->
                            <div class="mb-3">
                                <label for="check_out_date_<?php echo $reservation['reservation_id']; ?>" class="form-label">Check-Out Date</label>
                                <input type="date" class="form-control" id="check_out_date_<?php echo $reservation['reservation_id']; ?>" name="check_out_date" value="<?php echo $reservation['check_out_date']; ?>">
                            </div>
                            
                            <!-- Total Price -->
                            <div class="mb-3">
                                <label for="total_price_<?php echo $reservation['reservation_id']; ?>" class="form-label">Total Price</label>
                                <input type="number" class="form-control" id="total_price_<?php echo $reservation['reservation_id']; ?>" name="total_price" value="<?php echo $reservation['total_price']; ?>" step="0.01">
                            </div>
                            
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

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
