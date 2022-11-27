<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location:../index.php");
}

require("../inc/inc_database.php");
require("../inc/inc_fungsi.php");

// cek menu aktif
$request_uri = $_SERVER['REQUEST_URI'];
$ar = explode('/', $request_uri);
$last = $ar[count($ar) - 1];
if (str_starts_with($last, 'calon')) {
    $menu = 'calon_osis';
} elseif (str_starts_with($last, 'visi')) {
    $menu = 'visi_misi';
} elseif (str_starts_with($last, 'polling')) {
    $menu = 'polling_suara';
} elseif (str_starts_with($last, 'tps')) {
    $menu = 'tps';
} else {
    $menu = 'dashboard';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | E-Polling</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


    <!-- summernote -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    <!-- CSS Sendiri -->
    <link rel="stylesheet" href="../asset/style.css">

</head>

<body class="container bg-dark">



    <header class="p-3 text-bg-dark" style="border-bottom: 1px solid #444;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?= url_dasar_admin() . 'dashboard.php' ?>"
                            class="nav-link px-2 <?= $menu == 'dashboard' ? 'active' : 'text-white' ?>">Dashboard</a>
                    </li>
                    <li><a href="<?= url_dasar_admin() . 'calon_osis.php' ?>"
                            class="nav-link px-2 <?= $menu == 'calon_osis' ? 'active' : 'text-white' ?>">Data
                            Calon
                            OSIS</a></li>
                    <li><a href="<?= url_dasar_admin() . 'visi_misi.php' ?>"
                            class="nav-link px-2 <?= $menu == 'visi_misi' ? 'active' : 'text-white' ?>">Visi
                            Misi</a></li>
                    <li><a href="<?= url_dasar_admin() . 'tps.php' ?>"
                            class="nav-link px-2 <?= $menu == 'tps' ? 'active' : 'text-white' ?>">TPS</a></li>

                    <li><a href="<?= url_dasar_admin() . 'polling_suara.php' ?>"
                            class="nav-link px-2 <?= $menu == 'polling_suara' ? 'active' : 'text-white' ?>">Polling
                            Suara</a></li>
                </ul>

                <div class="text-end">
                    <a href="logout.php" class="btn btn-warning"
                        onclick="return confirm('Anda yakin ingin keluar ?')">Log Out</a>
                </div>
            </div>
        </div>
    </header>
    <main class="container p-4">