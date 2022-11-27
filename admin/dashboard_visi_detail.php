<?php include("inc_header.php") ?>
<?php
if (!isset($_GET['calon_id'])) {
    header("location:dashboard.php");
    exit();
}

// terima data
$calon_id = $_GET['calon_id'];

// cari data calon
$sql1 = "SELECT * FROM calon WHERE id=$calon_id";
$q1 = mysqli_query($koneksi, $sql1);
$r1 = mysqli_fetch_array($q1);
$nomor = $r1['nomor'];
$nama = $r1['nama'];
$wakil = $r1['wakil'];
$foto = parse_url_gambar($r1['foto']);
$visi = ambil_visi_misi($calon_id);

?>

<div class="card text-start d-flex flex-row">
    <img class="flex-1 card-img-top" style="object-fit: contain; width: 300px;" src="<?= $foto ?>" alt="Title" />
    <div class="flex-2 card-body d-flex flex-column justify-content-center align-items-center">
        <div class="card-title d-flex flex-column justify-content-center align-items-center"
            style="width:100%; border-bottom: 2px solid #ddd;">
            <h1 class="d-flex flex-column justify-content-center align-items-center"
                style="height: 100px; width: 100px; font-weight: 700; font-size: 4rem; border-radius: 50%; border: 2px solid #111;">
                <?= $nomor ?>
            </h1>
            <p style="font-weight: 600; font-size: 1rem;">
                <?= $nama . ' dan ' . $wakil ?>
            </p>
        </div>
        <div class="card-text">
            <p>
                <?= $visi ?>
            </p>
        </div>
        <hr>
        <a href="dashboard.php" class="btn btn-sm btn-outline-primary">
            << Kembali ke Dashboard</a>
    </div>
</div>

<?php include("inc_footer.php") ?>