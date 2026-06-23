<?php
include 'koneksi.php';

$cari = $_GET['cari'] ?? '';

if($cari != ''){
    //* Kegunaanya untuk menampilkan nama sekolah dan jurusan agar tidak memakai angka (1,2,3)
    $data = mysqli_query($conn,"
        SELECT
            p.*,
            s.nama_sekolah,
            j.nama_jurusan
        FROM pendaftaran p
        JOIN sekolah s ON p.id_sekolah = s.id_sekolah
        JOIN jurusan j ON p.id_jurusan = j.id_jurusan
        WHERE p.id_sekolah = 2
        AND (
            p.nama_lengkap LIKE '%$cari%' OR
            p.nisn LIKE '%$cari%' OR
            p.email LIKE '%$cari%'
        )
        ORDER BY p.id_pendaftaran DESC
    ");

}else{

    $data = mysqli_query($conn,"
        SELECT
            p.*,
            s.nama_sekolah,
            j.nama_jurusan
        FROM pendaftaran p
        JOIN sekolah s ON p.id_sekolah = s.id_sekolah
        JOIN jurusan j ON p.id_jurusan = j.id_jurusan
        WHERE p.id_sekolah = 2
        ORDER BY p.id_pendaftaran DESC
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tampil.css">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4 text-center">
        Data Pendaftar PPDB
    </h2>

    <div class="mb-3">
    <a href="index.php" class="btn btn-outline-dark btn-sm">
        ⬅ Kembali
    </a>
</div>

    <div class="card shadow p-4">
        <div class="table-responsive">

        <!-- FORM CARI -->
<form method="GET" class="d-flex mb-3" style="width:300px;">
    <input type="text"
           name="cari"
           class="form-control me-2"
           placeholder="Cari nama / NISN"
           value="<?= isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">

    <button type="submit" class="btn btn-primary">Cari</button>
</form>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Asal Sekolah</th>
                    <th>Pilihan Sekolah</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php   
            $no = 1;

            if(mysqli_num_rows($data) > 0){

            while($row = mysqli_fetch_assoc($data)){
            ?>

            <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nisn']; ?></td>
            <td><?= $row['nama_lengkap']; ?></td>
            <td><?= $row['jenis_kelamin']; ?></td>
            <td><?= $row['no_hp']; ?></td>
            <td><?= $row['tempat_lahir']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_lahir'])); ?></td>
            <td><?= $row['asal_sekolah']; ?></td>
            <td><?= $row['nama_sekolah']; ?></td>
            <td><?= $row['nama_jurusan']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])); ?></td>
            <td>
            <?php
                if($row['status']=="Lulus"){
                echo "<span class='badge bg-success'>Lulus</span>";
                }elseif($row['status']=="Tidak Lulus"){
                echo "<span class='badge bg-danger'>Tidak Lulus</span>";
                }else{
                echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
            }
            ?>
        </td>
    </tr>

        <?php
        }
        }else{
        ?>

        <tr>
        <td colspan="13" class="text-center fw-bold">
        Data tidak ditemukan
        </td>
    </tr>

        <?php } ?>

    </tbody>
</table>

    </div>

</div>

</body>
</html>