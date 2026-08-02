<?php
session_start();
require_once 'connect.php';

$db = new Connect();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $db->cancelBooking($_GET['id'], $_SESSION['user_id']);
}

header("Location: my-bookings.php");
exit();
?>