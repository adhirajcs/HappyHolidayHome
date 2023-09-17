<?php
# database
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Initialize variables
$homeId = $_POST['home_id'];

# Retrieve form data (add more fields as needed)
$name = $_POST["name"];
$location = $_POST["location"];
$availability_status = $_POST["availability_status"];
$description = $_POST["description"];
$rating = $_POST["rating"];
$price = $_POST["price"];

# Check if a file was uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileType = $_FILES['image']['type'];

    // Check if the uploaded file is an image
    if (strpos($fileType, 'image') !== false) {
        // Generate a unique filename for the uploaded image
        $Filename = $_FILES['image']['name'];

        // Define the directory where the uploaded images will be stored
        $uploadDirectory = "../assets/img/holiday-homes/"; 

        $filePath = $uploadDirectory . $Filename;

        // Move the uploaded file to the image directory
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Update the image_path in the database
            $updateQuery = "UPDATE holiday_homes SET
                name = ?,
                location = ?,
                availability_status = ?,
                description = ?,
                rating = ?,
                image_path = ?,
                price = ?
                WHERE home_id = ?";

            if ($stmt = $con->prepare($updateQuery)) {
                $stmt->bind_param("ssssdssi", $name, $location, $availability_status, $description, $rating, $filePath, $price, $homeId);

                if ($stmt->execute()) {
                    # Redirect back to view_holidayhomes.php after updating
                    header("Location: view_holidayhomes.php");
                    exit();
                } else {
                    $editError = "Error updating holiday home details: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $editError = "Error preparing the update statement: " . $con->error;
            }
        } else {
            $editError = "Error uploading the image.";
        }
    } else {
        $editError = "Invalid file type. Please upload an image.";
    }
} else {
    // File was not uploaded or an error occurred during upload, update other fields without changing the image
    $updateQuery = "UPDATE holiday_homes SET
        name = ?,
        location = ?,
        availability_status = ?,
        description = ?,
        rating = ?,
        price = ?
        WHERE home_id = ?";

    if ($stmt = $con->prepare($updateQuery)) {
        $stmt->bind_param("ssssdsi", $name, $location, $availability_status, $description, $rating, $price, $homeId);

        if ($stmt->execute()) {
            # Redirect back to view_holidayhomes.php after updating
            header("Location: view_holidayhomes.php");
            exit();
        } else {
            $editError = "Error updating holiday home details: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $editError = "Error preparing the update statement: " . $con->error;
    }
}

?>
