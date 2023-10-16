<?php
# database
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Fetch holiday home data from the database
$sqlHolidayHomes = "SELECT * FROM holiday_homes";
$resultHolidayHomes = $con->query($sqlHolidayHomes);

# Check if there are any holiday homes
if ($resultHolidayHomes->num_rows > 0) {
    $holidayHomes = $resultHolidayHomes->fetch_all(MYSQLI_ASSOC);
} else {
    // No holiday homes found
    $holidayHomes = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Holiday Homes</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/view_holidayhomes.css">
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

            <!-- Add New Holiday Home Button -->
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                Add New Holiday Home
            </button>
        </div>

            <!-- Display Holiday Homes in a Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($holidayHomes as $home) : ?>
                            <tr>
                                <td><?php echo $home['home_id']; ?></td>
                                <td><?php echo $home['name']; ?></td>
                                <td><?php echo $home['location']; ?></td>
                                <td>₹<?php echo $home['price']; ?></td>
                                <td>
                                <!-- Button to trigger the edit modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $home['home_id']; ?>">
                                    Edit
                                </button>
                                <a href="delete_holidayhome.php?id=<?php echo $home['home_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this holiday home?')">Delete</a>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Add New Holiday Home Modal -->
    <div class="modal fade <?php echo isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'dark-mode' : ''; ?>" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Holiday Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add Form -->
                    <form method="POST" action="insert_holidayhome.php" enctype="multipart/form-data">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="add_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        
                        <!-- Location -->
                        <div class="mb-3">
                            <label for="add_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="add_location" name="location" required>
                        </div>
                        
                        <!-- Availability Status -->
                        <div class="mb-3">
                            <label for="add_availability_status" class="form-label">Availability Status</label>
                            <input type="text" class="form-control" id="add_availability_status" name="availability_status" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="add_description" name="description" required>
                        </div>
                        
                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="add_rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="add_rating" name="rating" step="0.01" required>
                        </div>
                        
                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="add_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="add_image" name="image" accept="image/*" required>
                        </div>
                        
                        <!-- Price -->
                        <div class="mb-3">
                            <label for="add_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="add_price" name="price" step="0.01" required>
                        </div>
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Holiday Home</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for editing holiday homes -->
    <?php foreach ($holidayHomes as $home) : ?>
        <div class="modal fade <?php echo isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'dark-mode' : ''; ?>" id="editModal_<?php echo $home['home_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel_<?php echo $home['home_id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_<?php echo $home['home_id']; ?>">Edit Holiday Home No. <?php echo  $home['home_id'];?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Form -->
                        <form method="POST" action="update_holidayhome.php" enctype="multipart/form-data">
                            <!-- Hidden input to pass home_id to update_holidayhome.php -->
                            <input type="hidden" name="home_id" value="<?php echo $home['home_id']; ?>">
                            
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name_<?php echo $home['home_id']; ?>" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_<?php echo $home['home_id']; ?>" name="name" value="<?php echo $home['name']; ?>">
                            </div>
                            
                            <!-- Location -->
                            <div class="mb-3">
                                <label for="location_<?php echo $home['home_id']; ?>" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location_<?php echo $home['home_id']; ?>" name="location" value="<?php echo $home['location']; ?>">
                            </div>
                            
                            <!-- Availability Status -->
                            <div class="mb-3">
                                <label for="availability_status_<?php echo $home['home_id']; ?>" class="form-label">Availability Status</label>
                                <input type="text" class="form-control" id="availability_status_<?php echo $home['home_id']; ?>" name="availability_status" value="<?php echo $home['availability_status']; ?>">
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description_<?php echo $home['home_id']; ?>" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description_<?php echo $home['home_id']; ?>" name="description" value="<?php echo $home['description']; ?>">
                            </div>
                            
                            <!-- Rating -->
                            <div class="mb-3">
                                <label for="rating_<?php echo $home['home_id']; ?>" class="form-label">Rating</label>
                                <input type="number" class="form-control" id="rating_<?php echo $home['home_id']; ?>" name="rating" value="<?php echo $home['rating']; ?>" step="0.01">
                            </div>
                            
                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label for="image_<?php echo $home['home_id']; ?>" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image_<?php echo $home['home_id']; ?>" name="image" accept="image/*">
                            </div>
                            
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price_<?php echo $home['home_id']; ?>" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price_<?php echo $home['home_id']; ?>" name="price" value="<?php echo $home['price']; ?>" step="0.01">
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
    <?php include("inc/admin_footer.php"); ?>

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
