<?php
  include 'config/config.php';
  
  if(isset($_POST['submit'])){
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $query = mysqli_query($conn, "INSERT INTO pesan (name, email, message) VALUES ('$nama', '$email', '$pesan')");
    if($query){
        header('Location: index.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kontak Kami</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

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
        <h1>Kontak Kami</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="pesan">Pesan</label>
                <textarea class="form-control" name="pesan" id="pesan" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-4">Kirim</button>
            <a href="index.php" class="btn btn-danger mb-4">Kembali</a>
        </form>

        <h6>Tiktok : <a href="https://www.tiktok.com/@dpop_chicken15?is_from_webapp=1&sender_device=pc" target="_blank">@dpop_chicken15</a></h6>
        <h6>Instagram : <a href="https://www.instagram.com/d_popchicken15?igsh=MTV5MWV6d3ZkcmtkOQ==" target="_blank">@d_popchicken15</a></h6>
        <h6>Alamat : Jl. Karet Belakang Barat No.10, RT.10/RW.2 12940 Daerah Khusus Ibukota Jakarta
        </h6>
    </div>
</body>
</html>