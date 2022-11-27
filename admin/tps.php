<?php
include('inc_header.php');
include("../inc/inc_database.php");

?>


<?php

// panggil data
$sql = "SELECT * FROM tps ORDER BY nomor ASC";
$q = mysqli_query($koneksi, $sql);


?>


<div class="card text-start">
    <div class="card-body">
        <h4 class="card-title">Data Tempat Pemungutan Suara (Kotak Suara)</h4>
        <p class="card-text">Ini adalah data tempat pemungutan suara SMKN Campalagian.</p>
        <a href="tps_input.php" class="btn btn-sm btn-primary">Tambah TPS</a>
        <hr>

        <table class="table table-stripped table-responsive">
            <thead>
                <th>Nomor TPS</th>
                <th>Status Keaktifan</th>
                <th>Aksi / Opsi</th>
            </thead>

            <tbody>
                <?php
                while ($r = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td>
                        <?= $r['nomor'] ?>
                    </td>
                    <td>
                        <span class="badge bg-<?= $r['status'] == 1 ? 'success' : 'danger' ?>">
                            <?= $r['status']==1 ? 'Aktif' : 'Tidak Aktif' ?>
                        </span>


                    </td>
                    <td>
                        <a href="tps_aktifkan_atau_tidak.php?id=<?= $r['id'] ?>&status=<?= $r['status'] == 1 ? 'aktif' : 'tidak-aktif' ?>"
                            class="btn btn-sm btn-outline-<?= $r['status'] == 1 ? 'danger' : 'success' ?>">
                            <?= $r['status']==1 ? 'NonAktifkan' : 'Aktifkan' ?>
                        </a>

                        <a href="tps_hapus.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Anda yakin ingin menghapus TPS ini ?')">Hapus</a>
                    </td>
                </tr>


                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('inc_footer.php') ?>