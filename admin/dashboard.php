<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
}
?>

<?php 
include '../koneksi.php';

// ====================== SMK ======================
$total_smk = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE id_sekolah='1'"));

$laki_smk = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran
 WHERE id_sekolah='1'
 AND jenis_kelamin='Laki-laki'"));

$perempuan_smk = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran
 WHERE id_sekolah='1'
 AND jenis_kelamin='Perempuan'"));


// ====================== SMA ======================
$total_sma = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE id_sekolah='2'"));

$laki_sma = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran
 WHERE id_sekolah='2'
 AND jenis_kelamin='Laki-laki'"));

$perempuan_sma = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM pendaftaran
 WHERE id_sekolah='2'
 AND jenis_kelamin='Perempuan'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PPDB</title>

    <!-- CSS -->
    <link rel="stylesheet" href="dashboard.css">

</head>
<body>

<div class="sidebar">

    <div class="sidebar-header">
        <img src="../img/logosmk.png">
        <img src="../img/logosma.png">

        <h3>PPDB Admin</h3>
    </div>

    <a href="dashboard.php">🏠 Dashboard</a>

    <a href="../daftar.php">📝 Form Pendaftaran</a>

    <a href="tampil_smk.php">🏫 Data SMK</a>

    <a href="tampil_sma.php">🎓 Data SMA</a>

    <a href="logout.php" class="logout-menu">
        🚪 Logout
    </a>

</div>

<div class="main-content">

    <div class="topbar">

        <div>
            <h1>Dashboard PPDB</h1>
            <p>Selamat Datang, <?= $_SESSION['username']; ?></p>
        </div>

    </div>

    <div class="stats-grid">

        <div class="stat-card total">
            <h5>Total SMK</h5>
            <h2 id="total_smk"><?= $total_smk ?></h2>
        </div>

        <div class="stat-card laki">
            <h5>Laki-laki SMK</h5>
            <h2 id="laki_smk"><?= $laki_smk ?></h2>
        </div>

        <div class="stat-card perempuan">
            <h5>Perempuan SMK</h5>
            <h2 id="perempuan_smk"><?= $perempuan_smk ?></h2>
        </div>

        <div class="stat-card total">
            <h5>Total SMA</h5>
            <h2 id="total_sma"><?= $total_sma ?></h2>
        </div>

        <div class="stat-card laki">
            <h5>Laki-laki SMA</h5>
            <h2 id="laki_sma"><?= $laki_sma ?></h2>
        </div>

        <div class="stat-card perempuan">
            <h5>Perempuan SMA</h5>
            <h2 id="perempuan_sma"><?= $perempuan_sma ?></h2>
        </div>

    </div>

</div>
<script>

setInterval(function(){

    fetch('get_statistik.php')
    .then(response => response.json())
    .then(data => {

        document.getElementById('total_smk').innerHTML =
        data.total_smk;

        document.getElementById('laki_smk').innerHTML =
        data.laki_smk;

        document.getElementById('perempuan_smk').innerHTML =
        data.perempuan_smk;

        document.getElementById('total_sma').innerHTML =
        data.total_sma;

        document.getElementById('laki_sma').innerHTML =
        data.laki_sma;

        document.getElementById('perempuan_sma').innerHTML =
        data.perempuan_sma;

    });

}, 3000);

</script>
</body>
</html>