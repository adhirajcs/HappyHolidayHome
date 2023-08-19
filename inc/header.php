<?php
$isLoggedIn = false;
?>

<header>
    <nav class="navbar">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo" style="width: 30px; height: auto;">
        </div>
        <ul class="nav-links">
            <?php if ($isLoggedIn) : ?>
                <!-- Will display this for logged-in users -->
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
                <!-- will display this for unregistered users -->
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>