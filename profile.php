<?php
session_start();
require_once 'connect.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Connect();
$user_id = $_SESSION['user_id'];


$user = $db->selectonce('users', $user_id);

if (empty($user)) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Profile Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                        <!-- Profile Avatar / Image -->
                        <div class="flex-shrink-0">
                            <?php if (!empty($user['image'])): ?>
                                <img src="assets/images/<?= htmlspecialchars($user['image']) ?>" alt="Profile" class="rounded-circle object-fit-cover" width="100" height="100">
                            <?php else: ?>
                                <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-1" style="width: 100px; height: 100px;">
                                    <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <h3 class="fw-bold mb-1"><?= htmlspecialchars($user['name']) ?></h3>
                            <p class="text-muted mb-2"><i class="fa-regular fa-envelope me-1"></i> <?= htmlspecialchars($user['email']) ?></p>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">Active Member</span>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <h5 class="fw-bold text-dark mb-3">Personal Information</h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-muted small d-block mb-1">Full Name</span>
                                <strong class="text-dark fs-6"><?= htmlspecialchars($user['name']) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-muted small d-block mb-1">Email Address</span>
                                <strong class="text-dark fs-6"><?= htmlspecialchars($user['email']) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-muted small d-block mb-1">Phone Number</span>
                                <strong class="text-dark fs-6"><?= htmlspecialchars($user['phone'] ?? 'Not Provided') ?></strong>
                            </div>
                        </div>
                    </div>

                    <a href="edit_profile.php" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
                    </a>

                </div>
            </div>

            <!-- Security Section -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-shield-halved text-primary me-2"></i> Security Settings</h5>
                
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 bg-light p-3 rounded-3">
                    <div>
                        <h6 class="fw-bold mb-1">Password</h6>
                        <p class="text-muted small mb-0">Keep your account secure by changing your password regularly.</p>
                    </div>
                    <div>
                        <a href="change_pass.php" class="btn btn-outline-primary rounded-pill px-4 text-nowrap fw-semibold">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

