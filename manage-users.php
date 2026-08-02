<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";

$db = new Connect();

// حذف مستخدم
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $db->delete("users", $id);

    header("Location: manage-users.php");
    exit();
}

// جلب المستخدمين
$users = $db->select("users");

include "includes/header.php";
include "includes/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#212529;
    position:fixed;
}

.sidebar h3{
    color:white;
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:#ddd;
    text-decoration:none;
    padding:15px 20px;
}

.sidebar a:hover{
    background:#0d6efd;
    color:white;
}

.content{
    margin-left:250px;
    padding:30px;
}

.table{
    background:white;
    border-radius:10px;
}

.card{
    border:none;
    border-radius:15px;
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

<div class="card shadow">

<div class="card-header bg-primary text-white d-flex justify-content-between">

<h4 class="mb-0">Manage Users</h4>

<a href="add-user.php" class="btn btn-light">
<i class="fa fa-plus"></i>
 Add User
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover text-center align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php if(count($users)>0): ?>

<?php foreach($users as $user): ?>

<tr>

<td><?= $user['id']; ?></td>

<td><?= htmlspecialchars($user['name']); ?></td>

<td><?= htmlspecialchars($user['email']); ?></td>

<td>

<?php if($user['role']=="admin"): ?>

<span class="badge bg-danger">Admin</span>

<?php else: ?>

<span class="badge bg-success">User</span>

<?php endif; ?>

</td>

<td>

<a href="edit-user.php?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="manage-users.php?delete=<?= $user['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this user?');">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5">

No Users Found

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