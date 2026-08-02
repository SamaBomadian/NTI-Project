<?php
session_start();
require_once 'connect.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Connect();
$user_id = $_SESSION['user_id'];
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = $_POST;
    unset($data['update']);

    if ($db->update($data, 'users', $user_id)) {
        if (isset($_POST['name'])) {
            $_SESSION['user_name'] = $_POST['name'];
        }
        
        header("Location: profile.php");
        exit();
    } else {
        $error_msg = "Failed to update profile. Please try again.";
    }
}

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
        <div class="col-lg-6 col-md-8">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                
                <h3 class="fw-bold text-dark text-center mb-4">Edit Profile</h3>

                <?php if (!empty($error_msg)): ?>
                    <div class="alert alert-danger rounded-3" role="alert">
                        <?= htmlspecialchars($error_msg) ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    
                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-secondary">Full Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="name" 
                            name="name" 
                            value="<?= htmlspecialchars($user['name'] ?? '') ?>" 
                            placeholder="Enter your full name" 
                            required
                        >
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold text-secondary">Email Address</label>
                        <input 
                            type="email" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="email" 
                            name="email" 
                            value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                            placeholder="Enter your email address" 
                            required
                        >
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="phone" class="form-label fw-semibold text-secondary">Phone Number</label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="phone" 
                            name="phone" 
                            value="<?= htmlspecialchars($user['phone'] ?? '') ?>" 
                            placeholder="Enter your phone number"
                        >
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2">
                        <a href="profile.php" class="btn btn-light rounded-pill px-4 fw-semibold text-secondary">
                            Cancel
                        </a>
                        <button type="submit" name="update" class="btn btn-primary rounded-pill px-4 fw-semibold">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

