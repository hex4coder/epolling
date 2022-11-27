<?php
include("../inc/inc_database.php");
include("../inc/inc_fungsi.php");


if (isset($_GET['id'])) {
    $visi = ambil_visi_misi($_GET['id']);
    echo $visi;
} else {
    echo "";
}

?>