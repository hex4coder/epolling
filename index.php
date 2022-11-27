<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location:admin/dashboard.php");
}

require("inc/inc_database.php");



$error = '';
$sukses = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $raw_password = $password;

    if ($username == '' || $password == '') {
        $error = 'Lengkapi username dan password !';
    } else {
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $q = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($q) > 0) {
            $r = mysqli_fetch_array($q);
            if ($password == $r['password']) {
                $sukses = "Login sukses anda akan diarahkan setelah 2 detik.";
                $_SESSION['user'] = $r['name'];
                header("refresh:2;url=admin/dashboard.php");
            } else {
                $error = "Password tidak valid";
            }
        } else {
            $error = "Username tidak kami temukan";
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPolling SMKN Campalagian</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>



</head>

<body>
    <main style="background-color: blue; height: 100vh; display: flex; justify-content: center; align-items:center;">

        <form class="width: 80%;" action="" method="post">
            <div class="card text-start" style="width: 100%; padding: 20px 40px;">
                <div class="card-body">
                    <h4 class="card-title">E-Polling SMKNCampalagian</h4>
                    <p class="card-text">Silahkan masukkan ID anda dengan benar !</p>
                    <!-- sukses -->
                    <?php
                    if (!empty($sukses)) {

                    ?>
                    <div class="alert alert-primary" role="alert">

                        <?= $sukses ?>
                    </div>
                    <div class="progress">
                        <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                            aria-valuemax="100"></div>
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
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="username" name="username"
                            value="<?= $username ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormContpasswordrolTextarea1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="password"
                            value="<?= $raw_password ?>" name="password">
                    </div>
                    <hr>
                    <button type="submit" name="login" class="btn btn-primary">Login / Masuk</button>
                    <br>
                </div>
            </div>

        </form>
    </main>


    <script>
        var progress = document.getElementById('progress')
        var second = 2
        var delay = second * 1000 / 200
        var i = 0;
        update();

        function update() {
            if (i <= 100) {
                var style = `${i}%`;
                progress.style.width = style;
                i++;
                setTimeout(() => update(), delay);
            }
        }

    </script>
</body>

</html>