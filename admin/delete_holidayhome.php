<?php
# database
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $homeId = $_GET['id'];

    # Get the current image path from the database
    $sqlSelectImagePath = "SELECT image_path FROM holiday_homes WHERE home_id = ?";
    $stmtSelectImagePath = $con->prepare($sqlSelectImagePath);

    if ($stmtSelectImagePath) {
        $stmtSelectImagePath->bind_param("i", $homeId);
        
        # Execute the statement
        if ($stmtSelectImagePath->execute()) {
            $stmtSelectImagePath->store_result();

            if ($stmtSelectImagePath->num_rows == 1) {
                $stmtSelectImagePath->bind_result($imagePath);
                $stmtSelectImagePath->fetch();

                # Delete the image file from the server
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $stmtSelectImagePath->close();
    }

    # SQL query to delete the holiday home
    $sqlDeleteHome = "DELETE FROM holiday_homes WHERE home_id = ?";
    $stmt = $con->prepare($sqlDeleteHome);

    if ($stmt) {
        $stmt->bind_param("i", $homeId);

        # Execute the statement
        if ($stmt->execute()) {
            # Redirect back to view_holidayhomes.php after successful deletion
            header("Location: view_holidayhomes.php");
            exit();
        } else {
            # Handle error if deletion fails
            echo "Error deleting the holiday home: " . $stmt->error;
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