<?php
session_start();
require_once 'connect.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Connect();
$user_id = $_SESSION['user_id'];

$message = "";
$message_type = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';


    $user = $db->selectonce('users', $user_id);

    if (!$user) {
        $message = "User not found.";
        $message_type = "danger";
    } 
    
    elseif ($current_password !== $user['password'] && !password_verify($current_password, $user['password'])) {
        $message = "Current password is incorrect.";
        $message_type = "danger";
    } 

    elseif ($new_password !== $confirm_password) {
        $message = "New password and confirm password do not match.";
        $message_type = "danger";
    } 
   
    elseif (strlen($new_password) < 6) {
        $message = "New password must be at least 6 characters long.";
        $message_type = "danger";
    } 
    else {
        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $escaped_pass = $db->conn->real_escape_string($hashed_password);
        $update_query = "UPDATE users SET password = '$escaped_pass' WHERE id = $user_id";

        if ($db->conn->query($update_query)) {
            $message = "Password changed successfully!";
            $message_type = "success";
        } else {
            $message = "Failed to update password. Please try again.";
            $message_type = "danger";
        }
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                
                <h3 class="fw-bold text-dark text-center mb-2">Change Password</h3>
                <p class="text-muted text-center fs-6 mb-4">
                    Keep your account secure by creating a strong password that you don't use anywhere else.
                </p>

                <!-- تنبيهات الخطأ والنجاح -->
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?= $message_type ?> rounded-3" role="alert">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold text-secondary">Current Password</label>
                        <input 
                            type="password" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="current_password" 
                            name="current_password" 
                            placeholder="Enter your current password" 
                            required
                        >
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-semibold text-secondary">New Password</label>
                        <input 
                            type="password" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="new_password" 
                            name="new_password" 
                            placeholder="Enter your new password" 
                            required
                        >
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-semibold text-secondary">Confirm New Password</label>
                        <input 
                            type="password" 
                            class="form-control form-control-lg rounded-3 fs-6" 
                            id="confirm_password" 
                            name="confirm_password" 
                            placeholder="Confirm your new password" 
                            required
                        >
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2">
                        <a href="profile.php" class="btn btn-light rounded-pill px-4 fw-semibold text-secondary">
                            Cancel
                        </a>
                        <button type="submit" name="change_pass" class="btn btn-primary rounded-pill px-4 fw-semibold">
                            Change Password
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

