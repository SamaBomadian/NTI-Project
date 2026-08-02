<?php
session_start();
require_once 'connect.php';

$db = new Connect();

$car_id = $_GET['id'] ?? 0;
$car = $db->getCarById($car_id);

if (!$car) {
    header("Location: cars.php");
    exit();
}

include 'includes/header.php';
?>

<div class="container py-5">
    
    <a href="cars.php" class="btn btn-outline-secondary mb-4 rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-2"></i> Back to Cars
    </a>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
       
            <!-- صورة السيارة -->
            <div class="col-lg-6 bg-light d-flex align-items-center justify-content-center p-4">
                <img src="assets/images/<?= htmlspecialchars($car['image']); ?>" 
                     alt="<?= htmlspecialchars($car['brand']); ?>" 
                     class="img-fluid rounded-3" 
                     style="max-height: 350px; object-fit: contain;">
            </div>

            <!-- تفاصيل السيارة وفورم الحجز -->
            <div class="col-lg-6 p-4 p-md-5 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2 rounded-pill">
                            <?= htmlspecialchars($car['status']); ?>
                        </span>
                        <h3 class="text-primary fw-bold mb-0">
                            $<?= htmlspecialchars($car['price_per_day']); ?> <span class="fs-6 text-muted fw-normal">/ day</span>
                        </h3>
                    </div>

                    <h1 class="fw-bold text-dark display-6 mb-3">
                        <?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']); ?>
                    </h1>

                    <hr class="my-4">

                    <!-- مميزات السيارة -->
                    <h5 class="fw-bold mb-3">Car Features:</h5>
                    <div class="row g-3 mb-4 text-secondary fs-6">
                        <div class="col-6">
                            <i class="fa-regular fa-user text-primary me-2"></i> 
                            <strong>Passengers:</strong> <?= htmlspecialchars($car['passengers']); ?>
                        </div>
                        <div class="col-6">
                            <i class="fa-solid fa-gear text-primary me-2"></i> 
                            <strong>Transmission:</strong> <?= htmlspecialchars($car['transmission']); ?>
                        </div>
                        <div class="col-6">
                            <i class="fa-solid fa-car-side text-primary me-2"></i> 
                            <strong>Doors:</strong> <?= htmlspecialchars($car['doors']); ?>
                        </div>
                        <div class="col-6">
                            <i class="fa-regular fa-snowflake text-primary me-2"></i> 
                            <strong>A/C:</strong> <?= htmlspecialchars($car['air_conditioning']); ?>
                        </div>
                    </div>
                </div>

               
                <div>
                    <form action="booking-process.php" method="POST">
                        <input type="hidden" name="car_id" value="<?= $car['id']; ?>">

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Pick-up Date:</label>
                                <input type="date" name="start_date" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Return Date:</label>
                                <input type="date" name="end_date" class="form-control rounded-3" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow">
                            Proceed to Booking <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

