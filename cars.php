<?php
session_start();
require_once 'connect.php'; 

// 2. استقبال كلمة البحث لو تم استخدام السيرش
$search = $_GET['search'] ?? '';
$db = new Connect();
// 3. جلب السيارات
if (!empty($search)) {
    $cars = $db->searchCars($search);
} else {
    $cars = $db->select('cars');
}


include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Section: Popular Rental Deals -->
<section class="py-5 bg-light" id="cars">
    <div class="container">
        
        <!-- Header Heading -->
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-2 text-uppercase fs-7">
                POPULAR RENTAL DEALS
            </span>
            <h2 class="fw-bold text-dark display-6">Most popular cars rental deals</h2>
        </div>

        <!-- 🔍 Search Form (شريط البحث) -->
        <form action="cars.php" method="GET" class="row g-2 mb-5 justify-content-center">
            <div class="col-md-6">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control form-control-lg rounded-pill px-4" placeholder="Search by brand or model (e.g. Jaguar, Porsche)...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                </button>
            </div>
        </form>

        <!-- Cards Container Grid -->
        <div class="row g-4">

            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <!-- Card Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-2 custom-car-card">

                            <img src="assets/images/<?= htmlspecialchars($car['image']) ?>" class="card-img-top p-3" alt="<?= htmlspecialchars($car['brand']) ?>" style="height: 180px; object-fit: contain;">
                            
                            <div class="card-body d-flex flex-column pt-0">
                            
                                <h5 class="card-title fw-bold mb-1">
                                    <?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) ?>
                                </h5>

                                <div class="d-flex align-items-center mb-3 text-warning small">
                                    <span class="me-1">⭐</span>
                                    <span class="fw-bold text-dark me-1">4.8</span>
                                    <span class="text-muted">(1,250 reviews)</span>
                                </div>

                                <div class="row g-2 mb-4 text-muted small">
                                    <div class="col-6"><i class="fa-regular fa-user me-2"></i><?= htmlspecialchars($car['passengers']) ?></div>
                                    <div class="col-6"><i class="fa-solid fa-gear me-2"></i><?= htmlspecialchars($car['transmission']) ?></div>
                                    <div class="col-6"><i class="fa-regular fa-snowflake me-2"></i><?= htmlspecialchars($car['air_conditioning']) ?></div>
                                    <div class="col-6"><i class="fa-solid fa-car-side me-2"></i><?= htmlspecialchars($car['doors']) ?></div>
                                </div>

                                <hr class="text-secondary opacity-25 mt-auto mb-3">
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small">Price</span>
                                    <div>
                                        <span class="h5 fw-bold text-dark mb-0">$<?= htmlspecialchars($car['price_per_day']) ?></span>
                                        <span class="text-muted small">/day</span>
                                    </div>
                                </div>

                                <!-- زرار يوجه لصفحة التفاصيل مع رقم العربية -->
                                <a href="car-details.php?id=<?= $car['id'] ?>" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold text-center">
                                    Rent Now <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- في حالة البحث عن عربية مش موجودة -->
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No cars found matching your search.</h4>
                    <a href="cars.php" class="btn btn-outline-primary mt-2">View All Cars</a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>