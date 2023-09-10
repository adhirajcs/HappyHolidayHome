<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="assets/img/logo.jpg" alt="Logo" style="width: 30px; height: auto;">
            </a>
        </div>
        <ul class="nav-links">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
                <!-- Display this for logged-in users -->
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li class="dropdown">
                    <span class="profile-info">
                        <img src="assets/img/user.png" alt="Profile Icon" class="profile-icon">
                        <?php echo $_SESSION['name']; ?>
                    </span>
                    <ul class="dropdown-content">
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="reservations.php">My Reservations</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                
            <?php else : ?>
                <!-- Display this for unregistered users -->
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
