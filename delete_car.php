<?php
require_once 'connect.php';

$db = new Connect();

if (!isset($_GET['id'])) {
    header("Location: admin-cars.php");
    exit;
}

$id = (int)$_GET['id'];

$car = $db->selectonce("cars", $id);

if (!$car) {
    die("Car Not Found");
}

if ($db->delete("cars", $id)) {
    header("Location: admin-cars.php");
    exit;
} else {
    echo "Failed to delete car.";
}
?>