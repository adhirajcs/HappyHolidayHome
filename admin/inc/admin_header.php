<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <img src="assets/img/admin_logo.jpg" alt="HappyHolidayHome" class="website-icon" style="max-width: 50px;">
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php
                // Check if the user is logged in
                if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
                ?>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['admin_name']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                            <li><a class="dropdown-item bg-danger" href="admin_logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php
                } else {
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    $loginText = ($currentPage === 'admin_login.php') ? 'SIGNUP' : 'LOGIN';
                    $loginPage = ($currentPage === 'admin_login.php') ? 'admin_signup.php' : 'admin_login.php';
                    echo '<a class="btn btn-success" href="' . $loginPage . '">' . $loginText . '</a>';
                }
                ?>
            </li>
            &nbsp;&nbsp;
            <li class="nav-item">
                <button id="themeToggle" class="btn btn-light ml-auto">
                    <i id="darkModeIcon" class="fa-solid fa-moon"></i>
                    <i id="lightModeIcon" class="fa-regular fa-moon" style="display: none;"></i>
                </button>
            </li>
        </ul>
    </div>
</nav>
