<?php
session_start();
include 'config/config.php';
if(isset($_GET['add_to_cart']) && isset($_GET['id_produk'])){
    $id = $_GET['id_produk'];

    if(isset($_POST['add_to_cart'])){
        $productId = $_POST['product_id'];
        $productName = htmlspecialchars($_POST['product_name']);
        $productPrice = $_POST['product_price'];
        $qty = 1;
        $subtotal = $productPrice * $qty;
        $query = mysqli_query($conn, "SELECT * FROM cart WHERE id_product = $productId AND is_checkout = 0");

        $query = mysqli_query($conn, "SELECT * FROM cart WHERE id_product = $productId AND is_checkout = 0");

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $newQty = $row['quantity'] + 1;
            $newSubtotal = $productPrice * $newQty;

            $sql = mysqli_query($conn, "UPDATE cart SET quantity = $newQty, subtotal = $newSubtotal WHERE id_product = $productId AND is_checkout = 0");
        } else {
            $sql = mysqli_query($conn, "INSERT INTO cart (id_product, name, price, quantity, is_checkout, subtotal) VALUES ($productId, '$productName', '$productPrice', $qty, 0, $subtotal)");
        }

        if ($sql) {
            header("Location: view_cart.php");
            exit;
        }

    }
}
?>
