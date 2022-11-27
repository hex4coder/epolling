<?php

include("../inc/inc_database.php");

if (isset($_GET['calon_id']) && isset($_GET['nomor_tps'])) {

    $nomor_tps = $_GET['nomor_tps'];
    $calon_id = $_GET['calon_id'];

    // cari id tps dari database
    $sql = "SELECT * FROM tps WHERE nomor=$nomor_tps";
    $q = mysqli_query($koneksi, $sql);
    $r = mysqli_fetch_array($q);
    $tps_id = $r['id'];

    // masukkan kedalam suara
    $sqlU = "INSERT INTO suara(tps_id, calon_id) VALUES($tps_id, $calon_id)";
    $qU = mysqli_query($koneksi, $sqlU);

    // jika inputan berhasil, maka non aktifkan tps
    if ($qU) {
        $sqlN = "UPDATE tps SET status=0 WHERE id=$tps_id";
        $qN = mysqli_query($koneksi, $sqlN);
    }

    echo "done";
} else {
    echo "Error data tidak lengkap" . print_r($_GET);
}

?>