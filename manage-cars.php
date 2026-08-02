<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";

$db = new Connect();

// حذف سيارة
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    $db->delete("cars", $id);

    header("Location: manage-cars.php");
    exit();
}

// عرض السيارات
$cars = $db->select("cars");

include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Manage Cars</h2>

<a href="add-car.php" class="btn btn-primary">
<i class="fa fa-plus"></i>
Add Car
</a>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover text-center align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Image</th>
<th>Brand</th>
<th>Model</th>
<th>Price / Day</th>
<th>Status</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php if(count($cars)>0): ?>

<?php foreach($cars as $car): ?>

<tr>

<td><?= $car['id']; ?></td>

<td>

<?php if(!empty($car['image'])): ?>

<img src="uploads/<?= $car['image']; ?>" width="90" class="rounded">

<?php else: ?>

No Image

<?php endif; ?>

</td>

<td><?= htmlspecialchars($car['brand']); ?></td>

<td><?= htmlspecialchars($car['model']); ?></td>

<td>$<?= htmlspecialchars($car['price']); ?></td>

<td>

<?php if($car['status']=="available"): ?>

<span class="badge bg-success">Available</span>

<?php else: ?>

<span class="badge bg-danger">Booked</span>

<?php endif; ?>

</td>

<td>

<a href="edit-car.php?id=<?= $car['id']; ?>" class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="manage-cars.php?delete=<?= $car['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Delete this car?')">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="7">

No Cars Found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

<?php
include "includes/footer.php";
?>