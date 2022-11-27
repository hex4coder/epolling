<?php include("inc_header.php") ?>
<?php

// ambil data calon
$sql = "SELECT * FROM calon ORDER BY nomor DESC";
$qCalon = mysqli_query($koneksi, $sql);

$message = "";
$message_type = 0; // 0 = sukses, 1 = error

// cek post parameter
if (isset($_POST['input_visi_misi'])) {
    $id = $_POST['id'];
    $visi = $_POST['visi'];

    if (strlen($visi) < 5) {
        $message = "Masukkan visi misi yang valid.";
        $message_type = 1;
    } else {
        $sql = "SELECT * FROM visi WHERE calon_id=$id";
        $q = mysqli_query($koneksi, $sql);
        if ($q) {
            if (mysqli_num_rows($q) > 0) {
                // data sudah ada
                $sqlU = "UPDATE visi SET isi='$visi' WHERE calon_id=$id";
            } else {
                // data belum ada
                $sqlU = "INSERT INTO visi(calon_id, isi) VALUES($id, '$visi')";
            }
            $qU = mysqli_query($koneksi, $sqlU);
            if ($qU) {
                $message = "Update visi misi berhasil";
            } else {
                $message = "Update visi misi gagal";
                $message_type = 1;
            }
        } else {
            $message = "Pengecekan data calon gagal.";
            $message_type = 1;
        }
    }
}




?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Visi Misi Calon Ketua OSIS</h4>
        <p class="card-text">Berikut adalah data visi misi calon ketua OSIS SMKN Campalagian.</p>

        <?php
        if (!empty($message)) {
            header("refresh:1;url=visi_misi.php");
        ?>
        <div class="alert alert-<?= $message_type == 0 ? 'primary' : 'danger' ?>" role="alert">
            <?= $message ?>
        </div>
        <?php } ?>

        <hr>
        <div class="table-responsive">
            <table class="table table-stripped" id="table">
                <thead>
                    <th>#</th>
                    <th>Foto Calon</th>
                    <th>Pasangan</th>
                    <th>Visi Misi</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <!-- parsing data calon -->
                    <?php while ($r = mysqli_fetch_array($qCalon)) { ?>
                    <tr>
                        <td>
                            <?= $r['nomor'] ?>
                        </td>
                        <td>
                            <img src="<?= parse_url_gambar($r['foto']) ?>" alt="<?= $r['foto'] ?>"
                                style="height: 5rem; width: 5rem;">
                        </td>
                        <td>
                            <?= $r['nama'] ?> / <?= $r['wakil'] ?>
                        </td>
                        <td>
                            <?= ambil_visi_misi($r['id'], 10) ?>
                        </td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-id="<?php echo $r['id'] ?>" data-nama="<?php echo $r['nama'] ?>"
                                data-wakil="<?php echo $r['wakil'] ?>"
                                data-foto="<?php echo parse_url_gambar($r['foto']) ?>"
                                class="aksi btn btn-sm btn-outline-warning">Update
                                Visi Misi</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Visi Misi Pasangan : <span
                        style="font-weight: 700;" id="calon"></span></h5>
                <img src="" alt="Foto Pasangan" id="foto"
                    style="height: 3rem; width: 3rem; display: block; margin-left: 1rem; ">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <textarea id="summernote" name="visi" rows="100"></textarea>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
                <button type="submit" name="input_visi_misi" class="btn btn-primary" data-bs-dismiss="modal">Simpan Visi
                    Misi</button>
            </div>
        </div>
    </form>
</div>




<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 200,
        });

        $('#table').dataTable({
            lengthMenu: [
                [2, 5, 10, -1],
                [2, 5, 10, 'Semua'],
            ],
        }).on('draw.dt', function () {
            $('.aksi').on('click', function (event) {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var wakil = $(this).data('wakil');
                var foto = $(this).data('foto');
                var calon = nama + ' / ' + wakil
                $('#id').val(id)
                $('#calon').text(calon)
                $('#foto').attr('src', foto)

                $.get("visi_ambil.php?id=" + id, function (data, status) {
                    var visi = data
                    $('#summernote').summernote("code", visi)

                });
            })
        });

    });
</script>
<?php include("inc_footer.php") ?>