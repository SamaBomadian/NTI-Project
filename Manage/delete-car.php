<?php
require_once '../connect.php';

$db = new Connect();

if (!isset($_GET['id'])) {
    header("Location: manage-cars.php");
    exit;
}

$id = (int)$_GET['id'];

// التأكد أن السيارة موجودة
$car = $db->selectonce("cars", $id);

if (!$car) {
    die("Car Not Found");
}

// حذف السيارة
if ($db->delete("cars", $id)) {
    header("Location: manage-cars.php");
    exit;
} else {
    echo "Failed to delete car.";
}
?>