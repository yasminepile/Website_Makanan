<?php
include('config/config.php');

$query = mysqli_query($conn, "SELECT * FROM cart WHERE is_checkout = 0");
if (isset($_POST['submit'])) {
    $cartIds = $_POST['cart_id'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    foreach ($cartIds as $index => $cartId) {
        $qty = intval($quantities[$index]);
        $price = floatval($prices[$index]);
        $subtotal = $price * $qty;

        mysqli_query($conn, "UPDATE cart SET quantity = $qty, subtotal = $subtotal WHERE id = $cartId");
    }

    header("Location: checkout.php");
    exit;
}

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
        <h1>My Cart</h1>

        <?php
        if(mysqli_num_rows($query) > 0):
        ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hapus</th>
                        <th>Produk</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $row): ?>
                        <tr>
                            <td>
                                <a href="delete-cart.php?delete&id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                            <td><?= $row['name'] ?>, Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                            <td>
                                <input type="hidden" name="cart_id[]" value="<?= $row['id'] ?>">
                                <input type="hidden" name="price[]" value="<?= $row['price'] ?>">
                                <input type="hidden" name="quantity[]" value="<?= $row['quantity'] ?>">
                                <?= $row['quantity'] ?>
                            </td> 
                            <td>Rp<?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <button type="submit" name="submit" class="btn btn-success">Processed Checkout</button>
        </form>
        <?php elseif (mysqli_num_rows($query) === 0): ?>
        <p>Keranjangmu Kosong !!</p>
        <?php endif ?>
        <br>
        <a href="index.php" class="btn btn-warning">Lanjut Belanja</a>


    </div>
</body>
</html>
