<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="container sticky-top pt-3">
  <nav class="navbar navbar-expand-lg px-4 bg-body-tertiary rounded-4">
    <div class="container-fluid">

      <a class="navbar-brand fw-medium fs-4 d-flex align-items-center gap-2" href="index.php">
        <img src="assets/images/Group.png" alt="Logo" style="width:30px; height:30px;"/>
        <span class="logo fw-bold" style="color:#1572D3;">RENTCARS</span>
      </a>

      <!-- Mobile Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Nav Content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-lg-4 text-center">
          <li class="nav-item">
            <a class="nav-link text-primary" aria-current="page" href="index.php#home">Home</a>
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
        </ul>

        <div class="d-flex align-items-center gap-3 justify-content-center">
        <?php if (isset($_SESSION['user_id'])): ?>
           
            <a href="profile.php" class="text-primary fw-bold text-decoration-none">
                <i class="fa-solid fa-user me-1"></i> <?= htmlspecialchars($_SESSION['user_name'] ?? 'My Profile'); ?>
            </a>
            <a href="logout.php" class="btn btn-outline-secondary btn-sm">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-outline-primary">Sign In</a>
            <a href="register.php" class="btn btn-primary">Sign Up</a>
        <?php endif; ?>
        </div>

      </div>

    </div>
  </nav>
</div>