<?php
session_start();
require_once 'connect.php'; 

$db = new Connect();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin-cars.php");
    exit;
}

$id = $_GET['id'];

$car = $db->selectonce("cars", $id);

if (!$car) {
    die("Car Not Found");
}

if (isset($_POST['update'])) {

    $data = [
        "brand"            => $_POST['brand'],
        "model"            => $_POST['model'],
        "price_per_day"    => $_POST['price_per_day'],
        "passengers"       => $_POST['passengers'],
        "transmission"     => $_POST['transmission'],
        "doors"            => $_POST['doors'],
        "air_conditioning" => $_POST['air_conditioning'],
        "status"           => $_POST['status']
    ];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/' . $img_name);
        $data['image'] = $img_name;
    }

    if ($db->update($data, "cars", $id)) {
        header("Location: admin-cars.php");
        exit;
    } else {
        $error = "Update Failed! Please try again.";
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white p-4">
                    <h4 class="fw-bold mb-0"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Car</h4>
                </div>
                
                <div class="card-body p-4">

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger rounded-3">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="row g-3">
                            <!-- Brand -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Brand</label>
                                <input type="text" name="brand" class="form-control rounded-3" value="<?= htmlspecialchars($car['brand'] ?? '') ?>" required>
                            </div>

                            <!-- Model -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Model</label>
                                <input type="text" name="model" class="form-control rounded-3" value="<?= htmlspecialchars($car['model'] ?? '') ?>" required>
                            </div>

                            <!-- Price Per Day -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price / Day (EGP)</label>
                                <input type="number" step="0.01" name="price_per_day" class="form-control rounded-3" value="<?= htmlspecialchars($car['price_per_day'] ?? '') ?>" required>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="available" <?= (strtolower($car['status'] ?? '') == 'available') ? 'selected' : '' ?>>Available</option>
                                    <option value="rented" <?= (strtolower($car['status'] ?? '') == 'rented') ? 'selected' : '' ?>>Rented</option>
                                </select>
                            </div>

                            <!-- Passengers -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Passengers</label>
                                <input type="text" name="passengers" class="form-control rounded-3" value="<?= htmlspecialchars($car['passengers'] ?? '') ?>" placeholder="e.g. 5 Passengers" required>
                            </div>

                            <!-- Transmission -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Transmission</label>
                                <select name="transmission" class="form-select rounded-3">
                                    <option value="Auto" <?= (($car['transmission'] ?? '') == 'Auto') ? 'selected' : '' ?>>Auto</option>
                                    <option value="Manual" <?= (($car['transmission'] ?? '') == 'Manual') ? 'selected' : '' ?>>Manual</option>
                                </select>
                            </div>

                            <!-- Doors -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Doors</label>
                                <input type="text" name="doors" class="form-control rounded-3" value="<?= htmlspecialchars($car['doors'] ?? '') ?>" placeholder="e.g. 4 Doors" required>
                            </div>

                            <!-- Air Conditioning -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Air Conditioning</label>
                                <select name="air_conditioning" class="form-select rounded-3">
                                    <option value="Yes" <?= (($car['air_conditioning'] ?? '') == 'Yes') ? 'selected' : '' ?>>Yes</option>
                                    <option value="No" <?= (($car['air_conditioning'] ?? '') == 'No') ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Car Image</label>
                                <?php if (!empty($car['image'])): ?>
                                    <div class="mb-2">
                                        <img src="assets/images/<?= htmlspecialchars($car['image']) ?>" alt="Current Image" class="rounded-3" style="max-height: 80px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control rounded-3">
                                <small class="text-muted">Leave empty if you don't want to change the image.</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button class="btn btn-primary rounded-pill px-4" name="update">
                                Save Changes
                            </button>
                            <a href="manage-cars.php" class="btn btn-light border rounded-pill px-4">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

