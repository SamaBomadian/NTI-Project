
<?php
include "config.php";

$message = "";

$user_id = 1; // مؤقتًا لحد ما يبقى فيه Login

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = mysqli_query($conn, "SELECT password FROM users WHERE id='$user_id'");
    $user = mysqli_fetch_assoc($query);

    if (!$user) {

        $message = "<p style='color:red;'>User not found.</p>";

    } elseif ($current_password != $user['password']) {

        $message = "<p style='color:red;'>Current password is incorrect.</p>";

    } elseif ($new_password != $confirm_password) {

        $message = "<p style='color:red;'>New password and confirm password do not match.</p>";

    } else {

        mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE id='$user_id'");

        $message = "<p style='color:green;'>Password changed successfully.</p>";
    }
}
?>











<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password - RentCar</title>


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
           CHANGE PASSWORD
        ========================= */

        .password-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .password-container h1 {
            text-align: center;

            margin-bottom: 35px;

            font-size: 40px;

            color: #0b1f3a;
        }


        /* =========================
           PASSWORD CARD
        ========================= */

        .password-card {
            width: 100%;
            max-width: 650px;

            margin: 0 auto;

            padding: 40px;

            background-color: #ffffff;

            border-radius: 15px;

            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }


        /* =========================
           DESCRIPTION
        ========================= */

        .password-description {
            text-align: center;

            color: #777777;

            font-size: 15px;

            line-height: 1.6;

            margin-bottom: 30px;
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

        .password-buttons {
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

        .change-btn {
            padding: 12px 25px;

            border: none;

            border-radius: 8px;

            background-color: #0b5ed7;

            color: #ffffff;

            font-size: 15px;

            cursor: pointer;

            transition: 0.3s;
        }

        .change-btn:hover {
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

            .password-container h1 {
                font-size: 32px;
            }

            .password-card {
                padding: 30px 20px;
            }

            .password-buttons {
                flex-direction: column;

                align-items: stretch;
            }

            .cancel-btn,
            .change-btn {
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

        <div class="password-container">


            <h1>
                Change Password
            </h1>


            <div class="password-card">


                <p class="password-description">
                    Keep your account secure by creating a strong
                    password that you don't use anywhere else.
                </p>
    

                <form action="" method="POST">


                    <!-- Current Password -->

                    <div class="form-group">

                        <label for="current_password">
                            Current Password
                        </label>

                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            placeholder="Enter your current password"
                        >

                    </div>


                    <!-- New Password -->

                    <div class="form-group">

                        <label for="new_password">
                            New Password
                        </label>

                        <input
                            type="password"
                            id="new_password"
                            name="new_password"
                            placeholder="Enter your new password"
                        >

                    </div>


                    <!-- Confirm Password -->

                    <div class="form-group">

                        <label for="confirm_password">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            placeholder="Confirm your new password"
                        >

                    </div>


                    <!-- Buttons -->

                    <div class="password-buttons">


                        <a
                            href="profile.php"
                            class="cancel-btn"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="change-btn"
                        >
                            Change Password
                        </button>


                    </div>


                </form>


            </div>


        </div>

    </main>


</body>

</html>