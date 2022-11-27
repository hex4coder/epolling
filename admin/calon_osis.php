<?php
include("inc_header.php");
$sql = "select * from calon order by nomor asc";
$q = mysqli_query($koneksi, $sql);

// message
$message = (isset($_GET['message']) ? $_GET['message'] : '');
?>

<?php
if ($message != '') {
?>
<div class="alert alert-primary" role="alert">
    <?= $message ?>
</div>

<?php
    header("refresh:2;url=calon_osis.php");
} ?>

<div class="card">
    <div class="card-body" style="position:relative;">
        <a href="calon_input.php" class="btn btn-sm btn-primary" style="position:absolute;top:1rem;right:1rem;">Tambah
            Calon</a>
        <h5 class="card-title">Data Calon Pasangan Ketua/Wakil OSIS</h5>
        <p class="card-text">SMKN Campalagian berbasis IT dan BESTari.</p>

        <table class="table table-stripped" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama Ketua</th>
                    <th scope="col">Nama Wakil</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($r = mysqli_fetch_array($q)) {
                    $id = $r['id'];
                ?>
                <tr>
                    <th scope="row">
                        <?= $r['nomor'] ?>
                    </th>
                    <td>
                        <img src="<?= parse_url_gambar($r['foto']) ?>" alt="<?= $r['foto'] ?>"
                            style="height: 5rem; width: 5rem;">
                    </td>
                    <td>
                        <?= $r['nama'] ?>
                    </td>
                    <td>
                        <?= $r['wakil'] ?>
                    </td>
                    <td>
                        <a href="calon_input.php?op=edit&id=<?= $id ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                        <a href="calon_hapus.php?op=delete&id=<?= $id ?>" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Anda yakin ingin menghapus data ini ?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#table').DataTable({
            lengthMenu: [
                [2, 5, 10, 50, -1],
                [2, 5, 10, 50, 'Semua']
            ]
        });
    });
</script>


<?php include("inc_footer.php") ?>