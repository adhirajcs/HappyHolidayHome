<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHolidayHome - Login</title>
    <link rel="stylesheet" href="assets/css/signup-login.css">
    
</head>

<body>

    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>

    <div class="container">
        <form action="/" method="POST" class="form" onsubmit="return validateLoginForm()">
            <label>Enter your Email ID:</label>
            <input type="email" id="loginEmail" name="loginEmail" placeholder="username@abc.com" required>
            <label>Enter your Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <button type="submit" name="login" class="btn btn-success">Login</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            <p class="no-account">Don't have an account? <a href="signup.php">Sign up here</a></p>
        </form>

    </div>
    
    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>
