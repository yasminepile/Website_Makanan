<?php

include 'config/config.php';

if(isset($_GET['delete']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM cart WHERE id=$id");
    if($query){
        header("Location: view_cart.php");
    }
}