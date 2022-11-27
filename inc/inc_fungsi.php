<?php

function url_dasar()
{
    return 'http://localhost/epolling';
}

function parse_url_gambar($gambar)
{
    return url_dasar() . '/gambar/' . $gambar;
}

function url_dasar_admin()
{
    return url_dasar() . '/admin/';
}

function cek_data_calon($nomor)
{
    global $koneksi;
    $sql = "select * from calon where nomor='$nomor'";
    $q = mysqli_query($koneksi, $sql);
    return mysqli_num_rows($q);
}

function ambil_visi_misi($id, $kata = -1)
{
    global $koneksi;
    $sql = "SELECT * FROM visi WHERE calon_id=$id";
    $q = mysqli_query($koneksi, $sql);
    $ret = '';
    if (mysqli_num_rows($q) > 0) {
        $r = mysqli_fetch_array($q);
        $ret = $r['isi'];

        if ($kata != -1) {
            $daftar_kata = explode(" ", $ret);
            $daftar_kata = array_slice($daftar_kata, 0, $kata < count($daftar_kata) ? $kata : count($daftar_kata) - 1);
            $ret = implode(" ", $daftar_kata) . "....";
        }
    } else {
        $ret = '<p>Belum ada data.</p>';
    }

    return $ret;
}

function hapus_visi_misi($calon_id)
{
    global $koneksi;
    $sql = "SELECT * FROM visi WHERE calon_id=$calon_id";
    return mysqli_query($koneksi, $sql);
}

// fungsi menghitung suara berdasarkan id calon
function hitung_suara($calon_id)
{
    global $koneksi;
    $sql = "SELECT * FROM suara WHERE calon_id=$calon_id";
    $q = mysqli_query($koneksi, $sql);
    $jumlah = mysqli_num_rows($q);
    return $jumlah;
}

?>