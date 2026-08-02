<?php
session_start();
require_once 'connect.php'; 

$db = new Connect();
$cars = $db->select("cars");

include 'includes/header.php';

?>

<style>
    body {
        background: #f8f9fa;
    }

    .table-card {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }

    .table thead th {
        background: #0b1f3a !important;
        color: white;
        border: none;
        padding: 15px;
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
        padding: 12px;
    }

    .badge-available {
        background-color: #0d6efd;
        color: white;
    }

    .badge-rented {
        background-color: #dc3545;
        color: white;
    }
    
    .car-img-thumb {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
    }
</style>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manage Cars</h3>
            <p class="text-muted small mb-0">Add, edit or remove vehicles from the system</p>
        </div>

        <a href="add_car.php" class="btn btn-primary rounded-pill px-4 fw-semibold">
            <i class="fa-solid fa-plus me-1"></i> Add Car
        </a>
    </div>

    <div class="card table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Price / Day</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($cars) && count($cars) > 0): ?>

                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?= $car['id']; ?></td>
                            <td>
                                <?php if (!empty($car['image'])): ?>
                                    <img src="assets/images/<?= htmlspecialchars($car['image']); ?>" alt="car" class="car-img-thumb">
                                <?php else: ?>
                                    <i class="fa-solid fa-car text-secondary"></i>
                                <?php endif; ?>
                            </td>
                            <td class="fw-semibold"><?= htmlspecialchars($car['brand'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($car['model'] ?? ''); ?></td>
                            <td class="fw-bold text-primary"><?= htmlspecialchars($car['price_per_day'] ?? 0); ?> $</td>
                            <td>
                                <?php if (strtolower($car['status'] ?? '') == "available"): ?>
                                    <span class="badge badge-available rounded-pill px-3 py-2">
                                        Available
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-rented rounded-pill px-3 py-2">
                                        Rented
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_car.php?id=<?= $car['id']; ?>" class="btn btn-dark btn-sm rounded-pill px-3">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="delete_car.php?id=<?= $car['id']; ?>" 
                                   class="btn btn-danger btn-sm rounded-pill px-3"
                                   onclick="return confirm('Are you sure you want to delete this car?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-car fs-1 d-block mb-2 opacity-50"></i>
                            No Cars Found
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

