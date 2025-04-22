<?php
include('config/config.php');

$query = mysqli_query($conn, "SELECT * FROM order_details JOIN orders ON order_details.order_id = orders.id JOIN products ON order_details.product_id = products.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- [Favicon] icon -->
    <link rel="icon" href="admin/assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="admin/assets/fonts/tabler-icons.min.css" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="admin/assets/fonts/feather.css" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome.css" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="admin/assets/fonts/material.css" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="admin/assets/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="admin/assets/css/style-preset.css" >
</head>
<body>
    <div class="container">
        <h1>My Orders</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($query as $row): ?>
                    <tr>
                        <td><?= $row['name'] ?>, Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                        <td>
                            <?= $row['quantity'] ?>
                        </td> 
                        <td>Rp<?= number_format($row['total_price'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali</a>


    </div>
</body>
</html>
