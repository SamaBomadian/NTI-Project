<?php
require_once '../connect.php';

$db = new Connect();

if (!isset($_GET['id'])) {
    header("Location: manage-cars.php");
    exit;
}

$id = $_GET['id'];

$car = $db->selectonce("cars", $id);

if (!$car) {
    die("Car Not Found");
}

if (isset($_POST['update'])) {

    $data = [
        "brand"  => $_POST['brand'],
        "model"  => $_POST['model'],
        "year"   => $_POST['year'],
        "price"  => $_POST['price'],
        "status" => $_POST['status']
    ];

    if ($db->update($data, "cars", $id)) {
        header("Location: manage-cars.php");
        exit;
    } else {
        $error = "Update Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Car</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Car</h3>

</div>

<div class="card-body">

<?php if(isset($error)){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Brand</label>

<input
type="text"
name="brand"
class="form-control"
value="<?= htmlspecialchars($car['brand']) ?>"
required>

</div>

<div class="mb-3">

<label>Model</label>

<input
type="text"
name="model"
class="form-control"
value="<?= htmlspecialchars($car['model']) ?>"
required>

</div>

<div class="mb-3">

<label>Year</label>

<input
type="number"
name="year"
class="form-control"
value="<?= $car['year'] ?>"
required>

</div>

<div class="mb-3">

<label>Price</label>

<input
type="number"
name="price"
class="form-control"
value="<?= $car['price'] ?>"
required>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="available"
<?= $car['status']=="available" ? "selected" : "" ?>>
Available
</option>

<option value="rented"
<?= $car['status']=="rented" ? "selected" : "" ?>>
Rented
</option>

</select>

</div>

<button
class="btn btn-warning"
name="update">

Update Car

</button>

<a
href="manage-cars.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>