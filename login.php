<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Cars Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


</head>
<body>

<div class="overlay"></div>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="login-card">

        <div class="text-center">

            <h1 class="logo">
                <i class="fa-solid fa-car-side"></i>
                <span class="white">RENT</span><span class="blue">CARS</span>
            </h1>

            <h2>Welcome Back!</h2>

            <p>Log in to your account</p>

        </div>
        <form action="home.php" method="post">

    <div class="mb-3">
        <input type="email"
               name="email"
               class="form-control"
               placeholder="Email Address"
               required>
    </div>

    <div class="mb-3">
        <input type="password"
               name="password"
               class="form-control"
               placeholder="Password"
               required>
    </div>

    <button type="submit" class="btn btn-login w-100">
        Log In
    </button>

</form>
        


       


        <div class="text-center mt-3">

            <a href="#">Forgot Password?</a>

            <br><br>

            <span>Don't have an account?</span>

            <a href="#">Sign Up</a>

        </div>

    </div>

</div>

</body>
</html>