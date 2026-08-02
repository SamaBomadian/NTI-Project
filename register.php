<?php
include_once 'connect.php';

$obj = new connect();
$error = "";

if (isset($_POST['name'])) {
    if ($obj->checkEmail($_POST['email'])) {
        $error = "This Email already exists";
    } else {
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $obj->insert($_POST, 'users');
        header("Location: login.php"); 
        exit();
    }
}
?>

<?php include_once "includes/header.php"; ?>

<link rel="stylesheet" href="assets/css/auth.css">

<section class="logg">
    <div class="overlay"></div>

    <div class="main-wrapper">
        <div class="login-card">
            <div class="text-center">
                <h1 class="logo">
                    <i class="fa-solid fa-car-side"></i>
                    <span class="white">RENT</span><span class="blue">CARS</span>
                </h1>
                <h2>Welcome To our Website!</h2>
                <p>Sign up to create your account</p>

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error! </strong><?= $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
            
            <form action="" method="post">
                <div class="mb-3">
                    <label>User Name</label>
                    <input type="text" name="name" class="form-control" placeholder="User Name" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <br>
                <button type="submit" class="btn btn-login">Sign Up</button>
            </form>

            <div class="text-center mt-3">
                <span>Already have an account?</span>
                <a href="login.php">Log IN</a>
            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>