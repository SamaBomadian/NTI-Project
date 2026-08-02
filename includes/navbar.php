<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="container sticky-top pt-3">
    <nav class="navbar navbar-expand-lg px-4 bg-body-tertiary rounded-4 shadow-sm">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="navbar-brand fw-medium fs-4 d-flex align-items-center gap-2" href="index.php">
                <img src="assets/images/Group.png" alt="Logo" style="width:30px;height:30px;">
                <span class="fw-bold text-primary">RENTCARS</span>
            </a>

            <!-- Mobile -->
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Menu -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-lg-4 text-center">

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="index.php#home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="index.php#about">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="cars.php">Cars</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="index.php#contact">Contact</a>
                    </li>

                    <?php if(isset($_SESSION['user_id'])): ?>

                        <li class="nav-item">
                            <a class="nav-link text-primary" href="my-bookings.php">
                                My Bookings
                            </a>
                        </li>

                    <?php endif; ?>


                    <!-- Admin Only -->
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin"): ?>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-primary"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            Dashboard

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="dashboard.php">
                                    Dashboard
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="manage-users.php">
                                    Manage Users
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="manage-cars.php">
                                    Manage Cars
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="manage-bookings.php">
                                    Manage Bookings
                                </a>
                            </li>

                        </ul>

                    </li>

                    <?php endif; ?>

                </ul>


                <!-- Right Side -->
                <div class="d-flex align-items-center gap-3 justify-content-center">

                    <?php if(isset($_SESSION['user_id'])): ?>

                        <a href="profile.php"
                           class="text-decoration-none fw-bold text-primary">

                            <i class="fa-solid fa-user"></i>

                            <?= htmlspecialchars($_SESSION['user_name']); ?>

                        </a>

                        <a href="logout.php"
                           class="btn btn-outline-danger">

                            Log Out

                        </a>

                    <?php else: ?>

                        <a href="login.php"
                           class="btn btn-outline-primary">

                            Sign In

                        </a>

                        <a href="register.php"
                           class="btn btn-primary">

                            Sign Up

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>
    </nav>
</div>