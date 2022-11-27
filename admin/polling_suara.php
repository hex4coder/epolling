<?php include("inc_header.php") ?>

<!-- ambil data calon -->
<?php
include("../inc/inc_database.php");
require_once("../inc/inc_fungsi.php");

$sqlx = "SELECT * FROM calon ORDER BY nomor";
$qx = mysqli_query($koneksi, $sqlx);

?>


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Grafik Suara Calon OSIS</h4>
        <hr>
        <div class="d-flex flex-row">
            <!-- grafik 1 -->
            <div style="width: 100%;">
                <canvas id="grafik1">

                </canvas>
            </div>

            <!-- grafik 2 -->
        </div>
        <hr>
        <div class="d-flex flex-column" style="position: relative;">
            <div style="position: absolute; top: 1rem; right: 1rem;" class="d-flex gap-1">
                <a href="" class="btn btn-sm btn-primary">Refresh</a>
                <a onclick="return confirm('Anda yakin ingin menghapus semua suara ?')" href="polling_suara_reset.php"
                    class="btn btn-sm btn-outline-warning">Reset Data</a>
            </div>
            <h4 class="card-title">Polling</h4>
            <p class="card-text">Data hasil perolehan suara masing-masing calon ketua OSIS.</p>
        </div>
        <hr>
        <table class="table table-stripped table-responsive">
            <thead>
                <th>Nomor</th>
                <th>Calon</th>
                <th>Suara</th>
            </thead>

            <tbody>
                <?php while ($r = mysqli_fetch_array($qx)) { ?>
                <tr>
                    <td>
                        <?= $r['nomor'] ?>
                    </td>
                    <td>
                        <?='<b>' . $r['nama'] . '</b>' . ' dan ' . $r['wakil'] ?>
                    </td>
                    <td>
                        <span class="badge bg-info">
                            <?= hitung_suara($r['id']) ?> Suara
                        </span>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var labels = []
    var pollings = []
    var colors = []

    $.get("../api/ambil_data_calon.php", function (data, status) {
        var dataCalon = JSON.parse(data);

        // ambil nama calon
        dataCalon.forEach((calon) => {
            labels.push(calon.nama + ' dan ' + calon.wakil)
            pollings.push(calon.suara)
            colors.push(calon.warna)
        })

        // grafik 1
        const ctx = document.getElementById('grafik1');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Hasil Perolehan Suara Calon OSIS',
                    data: pollings,
                    backgroundColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>

<?php include("inc_footer.php") ?>