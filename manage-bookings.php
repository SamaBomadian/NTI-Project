<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";

$db = new Connect();

// حذف حجز
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    $db->delete("bookings", $id);

    header("Location: manage-bookings.php");
    exit();
}

// جلب الحجوزات
$bookings = $db->select("bookings");

include "includes/header.php";
include "includes/navbar.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Bookings</title>

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
    color:#fff;
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:#ddd;
    padding:15px 20px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#0d6efd;
    color:white;
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

</style>

</head>

<body>

<div class="sidebar">

<h3>Car Rental</h3>

<a href="dashboard.php">
<i class="fa fa-chart-line"></i>
 Dashboard
</a>

<a href="manage-users.php">
<i class="fa fa-users"></i>
 Manage Users
</a>

<a href="manage-cars.php">
<i class="fa fa-car"></i>
 Manage Cars
</a>

<a href="manage-bookings.php">
<i class="fa fa-calendar-check"></i>
 Manage Bookings
</a>

<a href="logout.php">
<i class="fa fa-right-from-bracket"></i>
 Logout
</a>

</div>

<div class="content">

<div class="card">

<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

<h4 class="mb-0">
Manage Bookings
</h4>

<a href="add-booking.php" class="btn btn-light">
<i class="fa fa-plus"></i>
Add Booking
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover text-center">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>User ID</th>

<th>Car ID</th>

<th>Pickup Date</th>

<th>Return Date</th>

<th>Status</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

<?php if(count($bookings)>0): ?>

<?php foreach($bookings as $booking): ?>

<tr>

<td><?= $booking['id']; ?></td>

<td><?= $booking['user_id']; ?></td>

<td><?= $booking['car_id']; ?></td>

<td><?= $booking['pickup_date']; ?></td>

<td><?= $booking['return_date']; ?></td>

<td>

<?php

if($booking['status']=="Pending"){

echo "<span class='badge bg-warning text-dark'>Pending</span>";

}elseif($booking['status']=="Approved"){

echo "<span class='badge bg-success'>Approved</span>";

}elseif($booking['status']=="Cancelled"){

echo "<span class='badge bg-danger'>Cancelled</span>";

}else{

echo "<span class='badge bg-secondary'>".$booking['status']."</span>";

}

?>

</td>

<td>

<a href="edit-booking.php?id=<?= $booking['id']; ?>" class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="manage-bookings.php?delete=<?= $booking['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Are you sure you want to delete this booking?')">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="7">

No Bookings Found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>
<?php
include "includes/footer.php";
?>