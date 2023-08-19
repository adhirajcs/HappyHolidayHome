<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHolidayHome</title>
    <link rel="stylesheet" href="assets/css/signup-login.css">
    
</head>

<body">
     
     <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>
    <br><br><br>

    <div class="container">
        <form action="/" method="POST" class="form" onsubmit="return validateForm()">
            <label>Enter your Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Full Name" required>
            <label>Enter your Email ID:</label>
            <input type="email" id="email" name="email" placeholder="username@abc.com" required>
            <label>Enter your Phone number:</label>
            <input type="tel" id="phone" name="phone" placeholder="0123456789" pattern="[0-9]{10}" required>
            <label>Enter your Password:</label>
            <input type="password" id="password" name="password" required>
            <label>Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <button type="submit" name="save" class="btn btn-success">Sign Up</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            <p class="no-account">Already have Account? <a href="login.php">Login here</a></p>
        </form>
    </div>

    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>
