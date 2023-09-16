<?php
# Include the database connection file
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    # SQL query to delete the reservation
    $sqlDeleteReservation = "DELETE FROM reservations WHERE reservation_id = ?";
    $stmt = $con->prepare($sqlDeleteReservation);

    if ($stmt) {
        $stmt->bind_param("i", $reservationId);

        # Execute the statement
        if ($stmt->execute()) {
            # Redirect back to view_reservations.php after successful deletion
            header("Location: view_reservations.php");
            exit();
        } else {
            # Handle error if deletion fails
            echo "Error deleting the reservation: " . $stmt->error;
        }

        # Close the statement
        $stmt->close();
    } else {
        # Handle error if the statement preparation fails
        echo "Error preparing statement: " . $con->error;
    }
} else {
    # Handle the case where 'id' parameter is not set in the URL
    echo "Invalid request.";
}
?>
