<?php
session_start();
include 'config/config.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM cart WHERE is_checkout = 0");

if ($query && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $payment_method = $_POST['payment_method'];

    $cart_ids = $_POST['cart_id'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    $totalPrice = 0;

    // Hitung total harga
    for ($i = 0; $i < count($prices); $i++) {
        $totalPrice += $quantities[$i] * $prices[$i];
    }

    // Simpan ke tabel orders
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, nama_penerima, alamat, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $user_id, $totalPrice, $nama, $alamat, $payment_method);

    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;

        // Simpan ke order_details
        $stmtDetail = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

        for ($i = 0; $i < count($cart_ids); $i++) {
            $cart_id = $cart_ids[$i];

            // Ambil product_id dari tabel cart
            $result = mysqli_query($conn, "SELECT id_product FROM cart WHERE id = $cart_id");
            $row = mysqli_fetch_assoc($result);
            $productId = $row['id_product'];

            $quantity = $quantities[$i];
            $price = $prices[$i];

            $stmtDetail->bind_param("iiid", $orderId, $productId, $quantity, $price);
            $stmtDetail->execute();

            // Update cart is_checkout
            mysqli_query($conn, "UPDATE cart SET is_checkout = 1 WHERE id = $cart_id");
        }

        $stmtDetail->close();
        echo "<script>alert('Checkout berhasil!'); window.location='orders.php';</script>";
    } else {
        echo "<script>alert('Checkout gagal.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
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
    <h1>Checkout</h1>
    <form action="" method="post">
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

      <div class="form-group">
          <label class="form-label" for="namaPenerima">Nama Penerima</label>
          <input type="text" name="nama" class="form-control" id="namaPenerima" required>
      </div>
    
      <div class="form-group">
          <label class="form-label" for="alamat">Alamat</label>
          <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
      </div>
      <div class="form-group">
          <label class="form-label" for="payment_method">Metode Pembayaran</label>
          <input type="text" name="payment_method" value="COD" class="form-control" id="payment_method" readonly>
      </div>
      <button type="submit" name="submit" class="btn btn-primary mb-4">Checkout</button>
      <a href="view_cart.php" class="btn btn-danger mb-4">Kembali</a>
  </form>
  </div>
</body>
</html>