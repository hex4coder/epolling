<?php
include('../inc/inc_database.php');
include('../inc/inc_fungsi.php');

if (isset($_GET['op'])) {
    $id = $_GET['id'];
    $id = preg_replace("/[^0-9]/", "", $id);
    // cari data untuk menghapus foto kandidat (memory free)
    $sql = "select * from calon where id=$id";
    $q = mysqli_query($koneksi, $sql);
    if ($q) {
        // hapus file foto
        $r = mysqli_fetch_array($q);
        $foto = $r['foto'];
        if ($foto != 'default_profile_picture.jpg') {
            @unlink('../gambar/' . $foto);
        }

        // hapus visi misi
        hapus_visi_misi($id);

        // hapus data
        $sql = "delete from calon where id=$id";
        $q = mysqli_query($koneksi, $sql);
        if ($q) {
            $message = 'Data calon tersebut berhasil dihapus.';
        } else {
            $message = 'Gagal dalam penghapusan data calon.';
        }
    } else {
        $message = 'Data tidak ditemukan.';
    }

    header("refresh:0;url=calon_osis.php?message=$message");
} else {
    echo "Tidak ada operasi";
}
?>