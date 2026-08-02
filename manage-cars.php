<?php
session_start();

if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";
$db = new Connect();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $db->delete("cars", $id);

    header("Location: manage-cars.php");
    exit();
}

$carsData = $db->select("cars");
$cars = is_array($carsData) ? $carsData : [];

include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid py-4">
    <div class="row">
        
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 bg-dark rounded-4 p-3 mb-4 text-white">
            <h4 class="text-center py-2 border-bottom border-secondary">Admin Panel</h4>
            <ul class="nav nav-pills flex-column gap-2 mt-3">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link text-white">
                        <i class="fas fa-chart-line me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage-users.php" class="nav-link text-white">
                        <i class="fas fa-users me-2"></i> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin-cars.php" class="nav-link active">
                        <i class="fas fa-car me-2"></i> Manage Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage-bookings.php" class="nav-link text-white">
                        <i class="fas fa-calendar-check me-2"></i> Manage Bookings
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a href="logout.php" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 ps-md-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Manage Cars</h2>
                <a href="add-car.php" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add Car
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle mb-0">
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
                                <?php if (count($cars) > 0): ?>
                                    <?php foreach ($cars as $car): ?>
                                        <tr>
                                            <td class="fw-bold">#<?= $car['id']; ?></td>
                                            <td>
                                                <?php if (!empty($car['image'])): ?>
                                                    <img src="assets/images/<?= $car['image']; ?>" width="80" height="50" class="rounded object-fit-cover" alt="Car">
                                                <?php else: ?>
                                                    <span class="text-muted">No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($car['brand'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($car['model'] ?? ''); ?></td>
                                            <td class="text-success fw-bold">$<?= htmlspecialchars($car['price'] ?? '0'); ?></td>
                                            <td>
                                                <?php if (isset($car['status']) && strtolower($car['status']) == "available"): ?>
                                                    <span class="badge bg-success rounded-pill px-3 py-2">Available</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">Booked</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="edit-car.php?id=<?= $car['id']; ?>" class="btn btn-warning btn-sm rounded-circle me-1" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="manage-cars.php?delete=<?= $car['id']; ?>" class="btn btn-danger btn-sm rounded-circle" title="Delete" onclick="return confirm('Are you sure you want to delete this car?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="py-4 text-muted">No Cars Found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
include "includes/footer.php";
?>