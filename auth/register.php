<?php
include_once '../config/connect.php';

$obj =new connect();
$error="";

if(isset($_POST['name'])){

    if($obj->checkEmail($_POST['email'])){
       $error="This Email already exists";
    } else {
        $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
        
        $obj->insert($_POST,'users');
        header("location:/nti-project(2)/auth/login.php");
        }

    }


?>

<?php include "../includes/header.php"; ?>



<style>
/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', Arial, sans-serif;
}


.logg {
    position: relative;
    background-image: url("/nti-project(2)/assets/images/log.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
}

.overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.25);
    z-index: 1;
}


.main-wrapper {
    position: relative;
    z-index: 2;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}


.login-card {
    width: 420px; 
    padding: 40px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    color: white;
}

.logo {
    font-size: 45px;
    margin-bottom: 20px;
}

.white { color: white; }
.blue { color: #1f8cff; }

.logo i {
    color: #1f8cff;
    margin-right: 8px;
}

h2 {
    font-weight: bold;
}

p {
    color: #ddd;
    margin-bottom: 25px;
}


.login-card .form-control {
    width: 100% !important;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.4);
    color: white !important;
    height: 50px;
    border-radius: 8px;
    padding-left: 30px;
}

.login-card .form-control::placeholder {
    color: #ddd;
}

.login-card .form-control:focus {
    background: rgba(255, 255, 255, 0.2);
    color: white !important;
    border-color: #1f8cff;
    box-shadow: none;
}


.btn-login {
    width: 100% !important;
    background: #1f8cff;
    color: white;
    border: none;
    height: 48px;
    border-radius: 8px;
    font-weight: bold;
    display: block;
}

.btn-login:hover {
    background: #0b74e5;
    color: white;
}

a {
    color: white;
    text-decoration: none;
}

a:hover {
    color: #1f8cff;
}
</style>

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

                <?php if(!empty($error)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
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
                    <input type="password" name="password" class="form-control " placeholder="Password" required>
                </div>
                <br>
                <button type="submit" class="btn btn-login">Sign Up</button>
            </form>

            <div class="text-center mt-3">
                
              
                <span>already have an account?</span>
                <a href="login.php">Log IN</a>
            </div>
        </div>
    </div>
</section>


<script src="/nti-project(2)/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>


