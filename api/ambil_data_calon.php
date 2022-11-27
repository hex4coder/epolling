<?php

// koneksi database dan fungsi
require("../inc/inc_database.php");
require("../inc/inc_fungsi.php");

// ini kode untuk ambil data
$sql = "SELECT * FROM calon ORDER BY nomor ASC";
$q = mysqli_query($koneksi, $sql);
$data = [];

// eksekusi data
while ($r = mysqli_fetch_array($q)) {
    array_push(
        $data,
        array(
            'id' => $r['id'],
            'nomor' => $r['nomor'],
            'nama' => $r['nama'],
            'wakil' => $r['wakil'],
            'foto' => parse_url_gambar($r['foto']),
            'suara' => hitung_suara($r['id']),
            'warna' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ',1)'
        )
    );
}

// tampilkan
echo json_encode($data);

?>