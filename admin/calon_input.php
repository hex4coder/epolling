<?php include("inc_header.php"); ?>
<?php
$nama = '';
$nomor = '';
$wakil = '';
$foto = '';
$error = '';
$sukses = '';
$id = '';
$database_foto = '';




if (isset($_GET['op'])) {
    $id = $_GET['id'];
    $id = preg_replace("/[^0-9]/", "", $id);
    $sql = "select * from calon where id = $id";
    $q = mysqli_query($koneksi, $sql);
    $r = mysqli_fetch_array($q);
    $nama = $r['nama'];
    $nomor = $r['nomor'];
    $wakil = $r['wakil'];
    $foto = $r['foto'];
    $database_foto = $foto;
}

if (isset($_POST['simpan'])) {
    if (!empty($_FILES['foto']['name'])) {
        // $sukses = 'Ada file';
        $nama = $_FILES['foto']['name'];
        $temp = $_FILES['foto']['tmp_name'];
        $type = $_FILES['foto']['type'];

        if (str_starts_with($type, 'image')) {
            $namafile = "calon_" . time() . substr($nama, -5);

            if (move_uploaded_file($temp, "../gambar/" . $namafile)) {
                $foto = $namafile;
            } else {
                $error = 'Proses upload file gagal.';
            }
        } else {
            $error = 'Maaf, file yang diupload harus gambar.';
        }

    } else {
        $foto = 'default_profile_picture.jpg';
        if ($database_foto != '') {
            $foto = $database_foto;
        }
    }

    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    $wakil = $_POST['wakil'];

    if ($nama == '' or $nomor == '' or $wakil == '') {
        $error = 'Mohon lengkapi data terlebih dahulu.';
    }

    if (empty($error)) {
        if ($id != '') {
            // operasi update
            // update gambar jika ada
            if ($foto != $database_foto and $database_foto != 'default_profile_picture.jpg') {
                @unlink('../gambar/' . $database_foto);
            }

            // update data
            $sql1 = "update calon set nama='$nama', foto='$foto', wakil='$wakil' where id=$id";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = 'Update data calon berhasil.';
                $database_foto = $foto;
                header('refresh:2;url=calon_osis.php');
            } else {
                $error = 'Update data gagal.';
            }
        } else {
            // operasi input
            if (cek_data_calon($nomor)) {
                $error = 'Maaf, calon dengan nomor tersebut sudah terdaftar.';
            } else {
                $sql1 = "insert into calon(nomor, nama, wakil, foto) values($nomor, '$nama', '$wakil', '$foto')";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = 'Entri data calon berhasil.';
                    $nama = '';
                    $wakil = '';
                    $nomor = '';
                    $foto = '';
                    $id = '';
                    header('refresh:2;url=calon_input.php');
                } else {
                    $error = 'Entri data gagal.';
                }
            }
        }

    }
}

?>


<div class="card">
    <div class="card-body" style="position:relative;">
        <a href="calon_osis.php" class="btn btn-sm btn-outline-primary"
            style="position: absolute; top: 1rem; right: 1rem;">
            << Kembali ke Data Calon</a>
                <h5 class="card-title">Manajemen Data Calon</h5>
                <p class="card-text">Silahkan input/edit data calon OSIS SMKN Campalagian.</p>

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
                <!-- forms -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    <div class="mb-3">
                        <label for="nomor" class="form-label">Nomor Pasangan Calon OSIS</label>
                        <select name="nomor" id="nomor" class="form-control" <?= isset($_GET['op']) ? 
                    'disabled="disabled"' : '' ?>>
                            <option value="">-- Pilih Nomor Pasangan --</option>
                            <option value="1" <?= $nomor=='1' ? 'selected="selected"' : '' ?>>1</option>
                            <option value="2" <?= $nomor=='2' ? 'selected="selected"' : '' ?>>2</option>
                            <option value="3" <?= $nomor=='3' ? 'selected="selected"' : '' ?>>3</option>
                            <option value="4" <?= $nomor=='4' ? 'selected="selected"' : '' ?>>4</option>
                            <option value="5" <?= $nomor=='5' ? 'selected="selected"' : '' ?>>5</option>
                        </select>
                        <?php

                        if (isset($_GET['op'])) {
                        ?>
                        <input type="hidden" name="nomor" value="<?= $nomor ?>">
                        <?php
                        }

                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Calon Ketua OSIS</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="NamaKetuaOsis"
                            value="<?php echo $nama ?>">
                    </div>
                    <div class="mb-3">
                        <label for="wakil" class="form-label">Wakil Calon Ketua OSIS</label>
                        <input type="text" class="form-control" name="wakil" id="wakil" aria-describedby="emailHelp"
                            value="<?php echo $wakil ?>">
                    </div>


                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Pasangan Calon OSIS</label>
                        <?php
                        if ($database_foto != '') {
                        ?>
                        <img src="<?= parse_url_gambar($database_foto) ?>" alt="Foto"
                            style="height: 5rem; width: 5rem; display: block;">
                        <?php
                        }
                        ?>
                        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="emailHelp"
                            accept="image/*">
                    </div>

                    <div class="card-footer">

                        <!-- button confirm -->
                        <button type="submit" class="btn btn-primary" name="simpan">Submit Data</button>
                    </div>
                </form>
    </div>
</div>
<?php include("inc_footer.php"); ?>