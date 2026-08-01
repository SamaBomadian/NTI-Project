<?php 
  session_start();
?>


<div class="container sticky-top pt-3">
  <nav class="navbar navbar-expand-lg px-4 bg-body-tertiary rounded-4 text-light">
    <div class="container-fluid">

        <a class="navbar-brand fw-medium fs-4 d-flex align-items-center me-5" href="#home.">
            <img src="/nti-project(2)/assets/images/Group.png " style="width:30px;height:30px;"/>
            <span  class="logo" style= "color:#1572D3;">RENTCARS</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-togglegit add ="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium gap-4">
                <li class="nav-item">
                    <a class="nav-link text-primary" aria-current="page" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#cars">Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#contact">Contact</a>
                </li>
            </ul> 
          <?php 
            if (isset($_SESSION['user_name'])){?>
            <a href="" class="btn btn-primary" style=" --bs-btn-padding-x: 2.75rem;"><?php echo $_SESSION['user_name']; ?></a>
          <?php }else{ ?>
            <a href="/nti-project(2)/auth/login.php" class="btn btn-primary" style=" --bs-btn-padding-x: 2.75rem;">Log In</a>
            <a href="/nti-project(2)/auth/register.php" class="btn btn-outline-primary" style=" --bs-btn-padding-x: 2.75rem;">Sign Up</a>

           ?>
           <?php } ?>
          <?php 
          if(isset($_SESSION['user_name'])){
          ?>
            <a class="nav-link text-primary" href="/nti-project(2)/auth/logout.php">Log Out</a>
          <?php
          }
          ?>
        </div>
    </div>
  </nav>
</div>