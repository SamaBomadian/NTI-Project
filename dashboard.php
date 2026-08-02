<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";

$db = new Connect();

// عدد المستخدمين
$users = count($db->select("users"));

// عدد السيارات
$cars = 0;
try {
    $cars = count($db->select("cars"));
} catch (Exception $e) {
    $cars = 0;
}

// عدد الحجوزات
$bookings = 0;
try {
    $bookings = count($db->select("bookings"));
} catch (Exception $e) {
    $bookings = 0;
}

include "includes/header.php";
include "includes/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#212529;
        }

        .sidebar h3{
            color:white;
            padding:20px;
            text-align:center;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 20px;
        }

        .sidebar a:hover{
            background:#0d6efd;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .icon{
            font-size:45px;
            opacity:.8;
        }
    </style>

</head>

<body>

<div class="sidebar">

    <h3>Car Rental</h3>

    <a href="dashboard.php">
        <i class="fas fa-chart-line"></i>
        Dashboard
    </a>

    <a href="manage-users.php">
        <i class="fas fa-users"></i>
        Manage Users
    </a>

    <a href="manage-cars.php">
        <i class="fas fa-car"></i>
        Manage Cars
    </a>

    <a href="manage-bookings.php">
        <i class="fas fa-calendar-check"></i>
        Manage Bookings
    </a>

    <a href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </a>

</div>

<div class="content">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Total Users</h5>
                        <h2><?= $users ?></h2>
                    </div>

                    <i class="fas fa-users icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Total Cars</h5>
                        <h2><?= $cars ?></h2>
                    </div>

                    <i class="fas fa-car icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Total Bookings</h5>
                        <h2><?= $bookings ?></h2>
                    </div>

                    <i class="fas fa-calendar-check icon"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4>Welcome Admin</h4>
            <p>Welcome to the Car Rental Management System Dashboard.</p>
        </div>
    </div>

</div>

</body>
</html>
<?php
include "includes/footer.php";
?>