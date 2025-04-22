<?php
session_start();
include('config/config.php'); // Koneksi ke database

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// Ambil semua produk dari tabel products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home | Ecommerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Style untuk tools bar */
        .tools-bar {
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .tools-bar a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        .tools-bar a:hover {
            background-color: #555;
        }

        /* Style untuk logo dan deskripsi */
        .company-info {
            text-align: center;
            margin-bottom: 30px; /* Tambahkan margin bottom */
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .company-info img {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }

        .company-info p {
            text-align: justify;
            line-height: 1.6;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #444;
            margin-bottom: 20px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        p {
            margin: 5px 0;
            color: #777;
        }

        form div button {
            background-color: #5cb85c;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 180px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Tools Bar -->
    <div class="tools-bar">
        <a href="index.php">Beranda</a>
        <a href="kontak.php">Kontak Kami</a>
        <a href="view_cart.php">Keranjang</a>
        <?php
        if($user_id == 0):
        ?>
        <a href="login.php">Login</a>
        <?php else:?>
        <a href="logout.php">Logout</a>
        <?php endif?>
    </div>

    <!-- Informasi Perusahaan (Beranda) -->
    <div class="company-info" id="beranda">
        <img src="logo_perusahaan.png" alt="Logo Perusahaan" style="max-width: 150px;">
        <p>D'Pop Chicken adalah bukti nyata bahwa semangat muda yang penuh kreativitas dapat berpadu dengan kualitas rasa yang istimewa dalam satu sajian kuliner. Kami adalah sekelompok pelajar kelas 12 yang tidak hanya memiliki semangat berwirausaha, tetapi juga tekad untuk menghadirkan produk yang berkualitas tinggi dan penuh inovasi. Melalui resep rahasia yang telah kami kembangkan secara cermat, setiap potongan ayam goreng yang kami sajikan memiliki cita rasa khas yang menggugah selera dan sulit untuk dilupakan.

Kami selalu mengutamakan penggunaan bahan baku terbaik yang segar dan higienis, sehingga pelanggan dapat menikmati ayam goreng yang tidak hanya lezat, tetapi juga aman dan bergizi. Dengan harga yang bersahabat dan pelayanan yang ramah, D'Pop Chicken hadir sebagai pilihan kuliner yang cocok untuk segala kalangan, mulai dari pelajar hingga keluarga. Lebih dari sekadar makanan, D'Pop Chicken adalah wujud dari kerja keras, kolaborasi, dan semangat generasi muda dalam menciptakan pengalaman rasa yang tak biasa. Di setiap gigitannya, Anda akan merasakan cerita dan semangat kami yang tersaji hangat. D'Pop Chicken bukan hanya ayam goreng—ini adalah perjalanan rasa yang istimewa dan penuh makna.

</p>
    </p>
    </div>

    <!-- Daftar Produk -->
    <h1 id="daftar-produk">Daftar Produk</h1>
    <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
    <li>
        <img src="admin/assets/images/uploads/<?php echo $row['image']?>" alt="" width="150">
        <h3><?php echo $row['name']; ?></h3>
        <p>Harga: Rp <?php echo number_format($row['price'], 2); ?></p>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <form method="POST" action="cart.php?add_to_cart&id_produk=<?php echo $row['id']?>">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
            <div>

                <button type="submit" name="add_to_cart">Tambah ke Keranjang</button>
            </div>
        </form>
    </li>
<?php endwhile; ?>
    </ul>

</body>
</html>
