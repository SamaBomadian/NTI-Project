<?php
session_start();

// 1. حماية الصفحة للأدمن فقط
if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}

require_once 'connect.php'; 
$db = new Connect();

// 2. معالجة حذف السيارة
if (isset($_GET['delete_car'])) {
    $id = (int)$_GET['delete_car'];
    $db->delete("cars", $id);
    header("Location: dashboard.php?page=cars");
    exit();
}

// 3. معالجة قبول أو إلغاء الحجز
if (isset($_GET['booking_action']) && isset($_GET['booking_id'])) {
    $b_id = (int)$_GET['booking_id'];
    $act = $_GET['booking_action'];

    if ($act == 'approve') {
        $db->update(['status' => 'Approved'], 'bookings', $b_id);
    } elseif ($act == 'cancel') {
        $db->update(['status' => 'Cancelled'], 'bookings', $b_id);
    }
    
    header("Location: dashboard.php?page=bookings");
    exit();
}

// تحديد الصفحة الحالية
$page = $_GET['page'] ?? 'dashboard';

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 bg-dark rounded-4 p-3 mb-4 text-white">
            <h4 class="text-center py-2 border-bottom border-secondary">Admin Panel</h4>
            <ul class="nav nav-pills flex-column gap-2 mt-3">
                <li class="nav-item">
                    <a href="dashboard.php?page=dashboard" class="nav-link <?= ($page == 'dashboard') ? 'active' : 'text-white'; ?>">
                        <i class="fas fa-chart-line me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?page=cars" class="nav-link <?= ($page == 'cars') ? 'active' : 'text-white'; ?>">
                        <i class="fas fa-car me-2"></i> Manage Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?page=users" class="nav-link <?= ($page == 'users') ? 'active' : 'text-white'; ?>">
                        <i class="fas fa-users me-2"></i> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?page=bookings" class="nav-link <?= ($page == 'bookings') ? 'active' : 'text-white'; ?>">
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

        <!-- Dynamic Content Area -->
        <div class="col-md-9 col-lg-10 ps-md-4">

            <?php if ($page == 'dashboard'): ?>
                <!-- ==================== 1. Dashboard Overview ==================== -->
                <?php 
                    $carsData = $db->select("cars") ?? [];
                    $usersData = $db->select("users") ?? [];
                    $bookingsData = $db->select("bookings") ?? [];
                ?>
                <div class="mb-4">
                    <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
                    <p class="text-muted small">Welcome back, Admin!</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">Total Cars</h6>
                                    <h2 class="fw-bold mb-0"><?= count($carsData); ?></h2>
                                </div>
                                <div class="fs-1 opacity-50"><i class="fas fa-car"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 bg-success text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">Registered Users</h6>
                                    <h2 class="fw-bold mb-0"><?= count($usersData); ?></h2>
                                </div>
                                <div class="fs-1 opacity-50"><i class="fas fa-users"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 bg-warning text-dark p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-dark-50 mb-1">Total Bookings</h6>
                                    <h2 class="fw-bold mb-0"><?= count($bookingsData); ?></h2>
                                </div>
                                <div class="fs-1 opacity-50"><i class="fas fa-calendar-check"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ($page == 'cars'): ?>
                <!-- ==================== 2. Manage Cars ==================== -->
                <?php $cars = $db->select("cars") ?? []; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Manage Cars</h2>
                        <p class="text-muted small mb-0">Add, edit or remove vehicles from the system</p>
                    </div>
                    <a href="add_car.php" class="btn btn-primary rounded-pill px-4 fw-semibold">
                        <i class="fa-solid fa-plus me-1"></i> Add Car
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
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
                                <?php if (!empty($cars) && count($cars) > 0): ?>
                                    <?php foreach ($cars as $car): ?>
                                        <tr>
                                            <td class="fw-bold">#<?= $car['id']; ?></td>
                                            <td>
                                                <?php if (!empty($car['image'])): ?>
                                                    <img src="assets/images/<?= htmlspecialchars($car['image']); ?>" width="70" height="45" class="rounded object-fit-cover" alt="Car">
                                                <?php else: ?>
                                                    <i class="fa-solid fa-car text-secondary fs-4"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td class="fw-semibold"><?= htmlspecialchars($car['brand'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($car['model'] ?? ''); ?></td>
                                            <td class="fw-bold text-success">$<?= htmlspecialchars($car['price_per_day'] ?? $car['price'] ?? 0); ?></td>
                                            <td>
                                                <?php if (strtolower($car['status'] ?? '') == "available"): ?>
                                                    <span class="badge bg-success rounded-pill px-3 py-2">Available</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">Rented</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="edit_car.php?id=<?= $car['id']; ?>" class="btn btn-warning btn-sm rounded-circle me-1" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="dashboard.php?delete_car=<?= $car['id']; ?>" 
                                                   class="btn btn-danger btn-sm rounded-circle" 
                                                   title="Delete"
                                                   onclick="return confirm('Are you sure you want to delete this car?');">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="py-5 text-muted">No Cars Found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($page == 'bookings'): ?>
                <!-- ==================== 3. Manage Bookings ==================== -->
                <?php $bookings = $db->select("bookings") ?? []; ?>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark mb-1">Manage Bookings</h2>
                    <p class="text-muted small mb-0">Review, approve, or cancel user rental requests</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle mb-0">
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
                                <?php if (!empty($bookings) && count($bookings) > 0): ?>
                                    <?php foreach ($bookings as $booking): ?>
                                        <?php $statusClean = trim(strtolower($booking['status'] ?? 'pending')); ?>
                                        <tr>
                                            <td class="fw-bold">#<?= $booking['id']; ?></td>
                                            <td><?= htmlspecialchars($booking['user_id']); ?></td>
                                            <td><?= htmlspecialchars($booking['car_id']); ?></td>
                                            <td><?= htmlspecialchars($booking['pickup_date']); ?></td>
                                            <td><?= htmlspecialchars($booking['return_date']); ?></td>
                                            <td>
                                                <?php if ($statusClean == 'confirmed' || $statusClean == 'approved'): ?>
                                                    <span class="badge bg-success rounded-pill px-3 py-2">Approved</span>
                                                <?php elseif ($statusClean == 'cancelled' || $statusClean == 'rejected'): ?>
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">Cancelled</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($statusClean == 'pending'): ?>
                                                    <a href="dashboard.php?page=bookings&booking_action=approve&booking_id=<?= $booking['id']; ?>" 
                                                       class="btn btn-sm btn-success rounded-pill px-3 me-1">
                                                        <i class="fas fa-check me-1"></i> Approve
                                                    </a>
                                                    <a href="dashboard.php?page=bookings&booking_action=cancel&booking_id=<?= $booking['id']; ?>" 
                                                       class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                       onclick="return confirm('Are you sure you want to cancel this booking?');">
                                                        <i class="fas fa-times me-1"></i> Cancel
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted small">No actions</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="py-5 text-muted">No Bookings Found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($page == 'users'): ?>
                <!-- ==================== 4. Manage Users ==================== -->
                <h2 class="fw-bold mb-4">Manage Users</h2>
                <div class="alert alert-info">قسم إدارة المستخدمين يظهر هنا.</div>

            <?php endif; ?>

        </div>

    </div>
</div>

<?php
include "includes/footer.php";
?>