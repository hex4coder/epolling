<?php
require("../inc/inc_database.php");

$sql = "SELECT * FROM suara";
$q = mysqli_query($koneksi, $sql);
while ($r = mysqli_fetch_array($q)) {
    $id = $r['id'];
    $sql2 = "DELETE FROM suara WHERE id=$id";
    $q2 = mysqli_query($koneksi, $sql2);
}

header("location:polling_suara.php");

?>