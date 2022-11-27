<?php
include("../inc/inc_database.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tps WHERE id=$id";
    $q = mysqli_query($koneksi, $sql);
    header("location:tps.php");
}

?>