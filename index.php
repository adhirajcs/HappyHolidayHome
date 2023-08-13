<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHolidayHome</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    
    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>
    
    <div class="container">
        <form action="/" method="POST" class="form">
            <label>Location:</label>
            <input type="text" name="name" placeholder="Your Location" required>
            <label>Check-In</label>
            <input type="text" name="name" placeholder="Your Check-In date" required>
            <label>Check-Out</label>
            <input type="text" name="name" placeholder="Your Check-Out date" required>
            
            <button type="submit" name="save" class="btn btn-success">Login</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
        </form>
    </div>
    
    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>