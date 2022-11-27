<?php



include("inc_header.php"); ?>

<?php

$sql = "SELECT * FROM calon ORDER BY nomor ASC";
$q = mysqli_query($koneksi, $sql);

?>


<div class="container">
    <div class="d-flex flex-wrap gap-4">
        <?php while ($r = mysqli_fetch_array($q)) { ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= parse_url_gambar($r['foto']) ?>" class="card-img-top" alt="Foto Calon Kandidat"
                style="height: 12rem;">
            <div class="card-body" style="position: relative;">
                <h1 style="font-weight: 700; font-size: 4rem;">
                    <?= $r['nomor'] ?>
                </h1>
                <h5 class="card-title">
                    <?= $r['nama'] . ' / ' . $r['wakil'] ?>
                </h5>
                <p class="card-text text-secondary" style="color: #ddd;">
                    <?= ambil_visi_misi($r['id'], 5) ?>
                </p>
                <a style="position: absolute; right: 1rem; top: 1rem;"
                    href="dashboard_visi_detail.php?calon_id=<?= $r['id'] ?>" class="btn btn-sm btn-primary">Lihat
                    Detail</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<?php include("inc_footer.php") ?>