<?php
include("../inc/inc_database.php");
include("inc_header.php");

// buat variabel
$error = '';
$sukses = '';

// tangkap data yang diinputkan
if (isset($_POST['simpan'])) {
    $nomor = $_POST['nomor'];
    $status = isset($_POST['status']) ? 1 : 0;

    if ($nomor == '') {
        $error = 'Silahkan lengkapi data';
    } else {

        // cari dulu data jika tidak ada maka tambahkan
        $sql1 = "SELECT * FROM tps WHERE nomor=$nomor";
        $q1 = mysqli_query($koneksi, $sql1);
        $ada = mysqli_num_rows($q1) > 0;

        // jika tidak ada, tambahkan
        if (!$ada) {
            $sql2 = "INSERT INTO tps(nomor, status) VALUES($nomor, $status)";
            $q2 = mysqli_query($koneksi, $sql2);
            if ($q2) {
                $sukses = "Berhasil menambahkan TPS";
            } else {
                $error = "Penginputan tidak berhasil";
            }
        } else {
            $error = "TPS dengan nomor tersebut sudah ada";
        }
    }

}


?>

<div class="card text-start">
    <div class="card-body">
        <h4 class="card-title">Form Penginputan Data TPS</h4>
        <p class="card-text">Silahkan masukkan data TPS dengan benar !</p>
        <!-- sukses -->
        <?php
        if (!empty($sukses)) {

        ?>
        <div class="alert alert-primary" role="alert">

            <?= $sukses ?>
        </div>
        <?php } ?>
        <!-- end sukses -->

        <!-- error -->
        <?php
        if (!empty($error)) {

        ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
        <?php } ?>
        <!-- end error -->
        <hr>
        <a href="tps.php" class="btn btn-sm btn-outline-primary">
            << Kembali</a>
                <hr>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nomor" class="form-label">Nomor TPS</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Masukkan Nomor TPS"
                            maxlength="1">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Keaktifan</label>
                        <br>
                        <input class="form-check-input" type="checkbox" value="" name="status" id="status">
                        <label class="form-check-label" for="status">
                            Aktif
                        </label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>
    </div>
</div>


<?php
include("inc_footer.php");
?>