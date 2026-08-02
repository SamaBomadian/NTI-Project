
<?php
require_once '../connect.php';

$db = new Connect();
$cars = $db->select("cars");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f9ff;
            font-family:Arial, Helvetica, sans-serif;
        }

        h2{
            color:#2563eb;
            font-weight:bold;
        }

        .table{
            border-radius:15px;
            overflow:hidden;
            background:#fff;
        }

        .table thead th{
            background:#2563eb !important;
            color:white;
            border:none;
            text-align:center;
        }

        .table tbody td{
            vertical-align:middle;
            text-align:center;
        }

        .table tbody tr:hover{
            background:#eef4ff;
        }

        .btn-add{
            background:#2563eb;
            color:white;
            border:none;
            border-radius:8px;
            padding:8px 18px;
        }

        .btn-add:hover{
            background:#1d4ed8;
            color:white;
        }

        .btn-edit{
            background:#2563eb;
            color:white;
            border:none;
        }

        .btn-edit:hover{
            background:#1d4ed8;
            color:white;
        }

        .btn-delete{
            background:#ef4444;
            color:white;
            border:none;
        }

        .btn-delete:hover{
            background:#dc2626;
            color:white;
        }

        .badge-available{
            background:#2563eb;
            color:white;
        }

        .badge-rented{
            background:#ef4444;
            color:white;
        }

    </style>

</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Cars</h2>

        <a href="add-car.php" class="btn btn-add">
            Add Car
        </a>

    </div>

    <div class="table-responsive shadow rounded">

        <table class="table table-bordered table-hover mb-0">

            <thead>

            <tr>

                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Status</th>
                <th width="180">Action</th>

            </tr>

            </thead>

            <tbody>

            <?php if(count($cars) > 0): ?>

                <?php foreach($cars as $car): ?>

                    <tr>

                        <td><?= $car['id']; ?></td>

                        <td><?= htmlspecialchars($car['brand']); ?></td>

                        <td><?= htmlspecialchars($car['model']); ?></td>

                        <td><?= $car['year']; ?></td>

                        <td><?= $car['price']; ?> EGP</td>

                        <td>

                            <?php if($car['status']=="available"): ?>

                                <span class="badge badge-available">
                                    Available
                                </span>

                            <?php else: ?>

                                <span class="badge badge-rented">
                                    Rented
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a href="edit-car.php?id=<?= $car['id']; ?>"
                               class="btn btn-edit btn-sm">
                                Edit
                            </a>

                            <a href="delete-car.php?id=<?= $car['id']; ?>"
                               class="btn btn-delete btn-sm"
                               onclick="return confirm('Are you sure?');">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7" class="text-center py-4">
                        No Cars Found
                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>