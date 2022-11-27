<?php
include("../inc/inc_database.php");

if (isset($_GET['nomor_tps'])) {
    $nomortps = $_GET['nomor_tps'];
    $sql = "SELECT * FROM tps WHERE nomor = $nomortps";
    $q = mysqli_query($koneksi, $sql);
    $r = mysqli_fetch_array($q);
    echo $r['status'];
} else {
    echo 0;
}


?>