<?php
session_start();
require_once 'connect.php'; 

$db = new Connect();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car_id'])) {

    $user_id = $_SESSION['user_id'];
    $car_id  = intval($_POST['car_id']);
    $start   = trim($_POST['start_date'] ?? '');
    $end     = trim($_POST['end_date'] ?? '');

    if (empty($start) || empty($end)) {
        die("Error: Please select both pick-up and return dates.");
    }

    if (strtotime($end) < strtotime($start)) {
        die("Error: Return date must be after or equal to the pick-up date.");
    }

    $car = $db->selectonce("cars", $car_id);
    if (!$car) {
        die("Error: Car not found.");
    }

    if ($db->isCarBooked($car_id, $start, $end)) {
        die("Error: This car is already booked for the selected dates.");
    }

    $bookingData = [
        "user_id"     => $user_id,
        "car_id"      => $car_id,
        "pickup_date" => $start,
        "return_date" => $end,
        "status"      => "Pending"
    ];

    if ($db->insert($bookingData, "bookings")) {
        header("Location: my-bookings.php?success=1");
        exit();
    } else {
        echo "Error: Booking Failed. Please try again.";
    }

} else {
    header("Location: index.php");
    exit();
}
?>