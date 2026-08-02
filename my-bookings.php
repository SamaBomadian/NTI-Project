<?php
session_start();
require_once 'connect.php';

$db = new Connect();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $db->getUserBookings($_SESSION['user_id']);
include_once "includes/header.php";
 include "includes/navbar.php"; 

?>

    <style>
        body { background: #f5f5f5; }
        .card { border: none; border-radius: 15px; }
        .card-img-top { height: 180px; object-fit: cover; }
    </style>


<div class="container mt-5 mb-5">
    <h2 class="mb-4 fw-bold">My Bookings</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
            Booking Added Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 overflow-hidden">
                            <img src="assets/images/<?php echo $row['image']; ?>" class="card-img-top" alt="Car Image">                        
                            <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-bold"><?php echo $row['brand'] . " " . $row['model']; ?></h4>
                                <hr>
                                <p class="mb-2"><b>Pick-up Date:</b> <?php echo $row['pickup_date']; ?></p>
                                <p class="mb-2"><b>Return Date:</b> <?php echo $row['return_date']; ?></p>
                                
                                <p class="mb-3">
                                    <b>Status:</b>
                                    <?php 
                                        $status = strtolower($row['status']);
                                        if ($status == 'pending') {
                                            echo "<span class='badge bg-warning text-dark px-3 py-2 rounded-pill'>Pending</span>";
                                        } elseif ($status == 'approved' || $status == 'confirmed') {
                                            echo "<span class='badge bg-success px-3 py-2 rounded-pill'>Confirmed</span>";
                                        } else {
                                            echo "<span class='badge bg-danger px-3 py-2 rounded-pill'>Cancelled</span>";
                                        }
                                    ?>
                                </p>
                            </div>

                            <?php 
                                $status = strtolower($row['status']);
                                ?>

                                <?php if ($status != 'cancelled'): ?>
                                    <a href="cancel-booking.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-outline-danger w-100 rounded-pill mt-2" 
                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                        Cancel Booking
                                    </a>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">No bookings found yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

