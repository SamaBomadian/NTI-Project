<?php
include "config.php";

$id = 1;

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - RentCar</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            RentCar
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="cars.php">Cars</a>
            <a href="my-bookings.php">My Bookings</a>
            <a href="profile.php" class="active">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <main>

        <div class="profile-container">

            <h1>My Profile</h1>

            <div class="profile-card">

                <div class="profile-image">

                    <?php
                    if (!empty($user['image'])) {
                        echo "<img src='images/" . $user['image'] . "' alt='Profile Image' width='120'>";
                    } else {
                        echo "<span>👤</span>";
                    }
                    ?>

                </div>

                <h2><?php echo $user['name']; ?></h2>

                <p class="profile-email">
                    <?php echo $user['email']; ?>
                </p>

                <div class="profile-info">

                    <div class="info-item">
                        <span class="label">Full Name</span>
                        <span class="value"><?php echo $user['name']; ?></span>
                    </div>

                    <div class="info-item">
                        <span class="label">Email</span>
                        <span class="value"><?php echo $user['email']; ?></span>
                    </div>

                    <div class="info-item">
                        <span class="label">Phone</span>
                        <span class="value"><?php echo $user['phone']; ?></span>
                    </div>

                </div>

                <a href="edit-profile.php" class="edit-btn" style="display:inline-block; text-decoration:none;">
                    Edit Profile
                </a>

            </div>

            <div class="security-section">

                <h3>Security</h3>

                <div class="security-content">

                    <div>
                        <h4>Password</h4>
                        <p>
                            Keep your account secure by changing
                            your password regularly.
                        </p>
                    </div>

                    <a href="change-password.php" class="password-btn" style="text-decoration:none; display:inline-block;">
                        Change Password
                    </a>

                </div>

            </div>

        </div>

    </main>

</body>

</html>