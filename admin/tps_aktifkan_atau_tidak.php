<?php
include("../inc/inc_database.php");
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $status = $status == 'aktif' ? 0 : 1;

    $sql = "UPDATE tps SET status=$status WHERE id=$id";
    $q = mysqli_query($koneksi, $sql);

    header("location:tps.php");
}

?>