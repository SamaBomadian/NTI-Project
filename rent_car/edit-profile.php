
<?php
include "config.php";

$id = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "UPDATE users
            SET name='$name',
                email='$email',
                phone='$phone'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: profile.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>














<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Profile - RentCar</title>


    <style>

        /* =========================
           GENERAL
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #111827;
        }


        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            width: 100%;
            min-height: 80px;

            background-color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 8%;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #0b1f3a;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333333;
            font-size: 16px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #0b5ed7;
        }

        .nav-links .active {
            color: #0b5ed7;
            font-weight: bold;
        }


        /* =========================
           MAIN
        ========================= */

        main {
            padding: 60px 8%;
        }


        /* =========================
           EDIT PROFILE
        ========================= */

        .edit-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .edit-container h1 {
            text-align: center;

            margin-bottom: 35px;

            font-size: 40px;

            color: #0b1f3a;
        }


        /* =========================
           EDIT CARD
        ========================= */

        .edit-card {
            width: 100%;
            max-width: 650px;

            margin: 0 auto;

            padding: 40px;

            background-color: #ffffff;

            border-radius: 15px;

            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            width: 100%;

            margin-bottom: 22px;

            text-align: left;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            color: #0b1f3a;
        }

        .form-group input {
            display: block;

            width: 100%;

            height: 48px;

            padding: 12px 15px;

            border: 1px solid #dddddd;

            border-radius: 8px;

            background-color: #ffffff;

            color: #333333;

            font-size: 15px;

            outline: none;

            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #0b5ed7;

            box-shadow: 0 0 0 3px rgba(11, 94, 215, 0.1);
        }


        /* =========================
           BUTTONS
        ========================= */

        .form-buttons {
            width: 100%;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 12px;

            margin-top: 30px;
        }

        .cancel-btn {
            display: inline-block;

            padding: 12px 25px;

            border-radius: 8px;

            background-color: #eeeeee;

            color: #333333;

            text-decoration: none;

            font-size: 15px;

            transition: 0.3s;
        }

        .cancel-btn:hover {
            background-color: #dddddd;
        }

        .save-btn {
            padding: 12px 25px;

            border: none;

            border-radius: 8px;

            background-color: #0b5ed7;

            color: #ffffff;

            font-size: 15px;

            cursor: pointer;

            transition: 0.3s;
        }

        .save-btn:hover {
            background-color: #084298;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .navbar {
                min-height: auto;

                padding: 20px 5%;

                flex-direction: column;

                gap: 20px;
            }

            .nav-links {
                gap: 15px;

                flex-wrap: wrap;

                justify-content: center;
            }

            main {
                padding: 40px 5%;
            }

            .edit-container h1 {
                font-size: 32px;
            }

            .edit-card {
                padding: 30px 20px;
            }

            .form-buttons {
                flex-direction: column;

                align-items: stretch;
            }

            .cancel-btn,
            .save-btn {
                width: 100%;

                text-align: center;
            }
        }

    </style>

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

        <div class="logo">
            RentCar
        </div>


        <div class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="cars.php">
                Cars
            </a>

            <a href="my-bookings.php">
                My Bookings
            </a>

            <a href="profile.php" class="active">
                Profile
            </a>

            <a href="logout.php">
                Logout
            </a>

        </div>

    </nav>


    <!-- =========================
         MAIN
    ========================= -->

    <main>

        <div class="edit-container">


            <h1>
                Edit Profile
            </h1>


            <div class="edit-card">


                <form action="" method="POST">


                    <!-- Full Name -->

                    <div class="form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                           value="<?php echo $user['name']; ?>"
                            placeholder="Enter your full name"
                        >

                    </div>


                    <!-- Email -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo $user['email']; ?>"
                            placeholder="Enter your email"
                        >

                    </div>


                    <!-- Phone -->

                    <div class="form-group">

                        <label for="phone">
                            Phone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                          value="<?php echo $user['phone']; ?>"
                            placeholder="Enter your phone number"
                        >

                    </div>


                    <!-- Buttons -->

                    <div class="form-buttons">


                        <a
                            href="profile.php"
                            class="cancel-btn"
                        >
                            Cancel
                        </a>


                       <button
    type="submit"
    name="update"
    class="save-btn"
>
    Save Changes
</button>

                    </div>


                </form>


            </div>


        </div>

    </main>


</body>

</html>