<?php
session_start();

// 1. حماية الصفحة للأدمن فقط
if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}

require_once 'connect.php'; 
$db = new Connect();

// 2. جلب إحصائيات النظام لعرضها في الداشبورد
$carsData = $db->select("cars") ?? [];
$usersData = $db->select("users") ?? [];
$bookingsData = $db->select("bookings") ?? []; // لو عندك جدول حجوزات

$totalCars = count($carsData);
$totalUsers = count($usersData);
$totalBookings = count($bookingsData);

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
                    <a href="dashboard.php" class="nav-link active">
                        <i class="fas fa-chart-line me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin-cars.php" class="nav-link text-white">
                        <i class="fas fa-car me-2"></i> Manage Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage-users.php" class="nav-link text-white">
                        <i class="fas fa-users me-2"></i> Manage Users
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

        <!-- Main Dashboard Content Area -->
        <div class="col-md-9 col-lg-10 ps-md-4">
            
            <div class="mb-4">
                <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
                <p class="text-muted small">Welcome back, Admin!</p>
            </div>

            <!-- Summary Cards / Statistics -->
            <div class="row g-4 mb-4">
                
                <!-- Total Cars Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Cars</h6>
                                <h2 class="fw-bold mb-0"><?= $totalCars; ?></h2>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-success text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Registered Users</h6>
                                <h2 class="fw-bold mb-0"><?= $totalUsers; ?></h2>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Bookings Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-warning text-dark p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-dark-50 mb-1">Total Bookings</h6>
                                <h2 class="fw-bold mb-0"><?= $totalBookings; ?></h2>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<?php
include "includes/footer.php";
?>