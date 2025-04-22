<?php
include 'config/config.php';

if(isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $no_telepon = $_POST['no_telepon'];
    $password = htmlspecialchars($_POST['password']);

    $query = mysqli_query($conn, "INSERT INTO users (username, email, no_telepon, password, role) VALUES ('$username', '$email', '$no_telepon', '$password', 'Customer')");

    if($query){
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Register | Ecommerce</title>
  <!-- [Meta] -->
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
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Register</b></h3>
              <a href="login.php" class="link-primary">Already have an account? Login</a>
            </div>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="number" class="form-control" name="no_telepon" placeholder="No Telepon" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
                </div>
            </form>
          </div>
        </div>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="admin/assets/js/plugins/popper.min.js"></script>
  <script src="admin/assets/js/plugins/simplebar.min.js"></script>
  <script src="admin/assets/js/plugins/bootstrap.min.js"></script>
  <script src="admin/assets/js/fonts/custom-font.js"></script>
  <script src="admin/assets/js/pcoded.js"></script>
  <script src="admin/assets/js/plugins/feather.min.js"></script>

  <script>layout_change('light');</script>
  <script>change_box_container('false');</script>
  <script>layout_rtl_change('false');</script>
  <script>preset_change("preset-1");</script>
  <script>font_change("Public-Sans");</script>
</body>
<!-- [Body] end -->

</html>