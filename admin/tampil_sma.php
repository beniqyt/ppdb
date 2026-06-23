<?php
include '../koneksi.php';

$cari = $_GET['cari'] ?? '';

if($cari != ''){

    $query = mysqli_query($conn,"
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

    $query = mysqli_query($conn,"
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tampilan.css">
</head>
<body>

<div class="container py-5">

    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex justify-content-between align-items-center mb-4">

    <!-- FORM CARI -->
    <form method="GET" class="d-flex" style="width:300px;">
        <input type="text"
               name="cari"
               class="form-control me-2"
               placeholder="Cari nama / NISN"
               value="<?= isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">

        <button type="submit" class="btn btn-primary">
            Cari
        </button>
    </form>
</div>
        <h2>Data Pendaftar PPDB</h2>

        <a href="../daftar.php" class="btn btn-primary">
            Tambah Pendaftar
        </a>

        <a href="export_sma.php" class="btn btn-success">
        Export Excel
        </a>
    </div>

    <div class="card shadow p-4">

        <div class="table-responsive" id="dataTabel">

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Asal Sekolah</th>
                    <th>Pilihan Sekolah</th>
                    <th>Jurusan</th>
                    <th>Tanggal Daftar</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

<?php
$no = 1;

if(mysqli_num_rows($query) > 0){

while($row = mysqli_fetch_assoc($query)) {
?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nisn']; ?></td>
                    <td style="white-space: normal;">
                    <?= $row['nama_lengkap']; ?>
                    </td>
                    <td style="white-space: normal;">
                    <?= $row['email']; ?>
                    </td>
                    <td><?= $row['jenis_kelamin']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
                    <td><?= $row['tempat_lahir']; ?></td>
                     <td><?= date('d-m-Y', strtotime($row['tanggal_lahir'])); ?></td>
                    <td><?= $row['asal_sekolah']; ?></td>
                    <td><?= $row['nama_sekolah']; ?></td>
                    <td><?= $row['nama_jurusan']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])); ?></td>
                    <td style="white-space: normal;">
                    <?= $row['alamat']; ?>
                    </td>
                    <td>
                        <?php
                        if($row['status']=='Lulus'){
                            echo '<span class="badge bg-success">Lulus</span>';
                            }
                            elseif($row['status']=='Tidak Lulus'){
                                echo '<span class="badge bg-danger">Tidak Lulus</span>';
                                }
                                else{
                                    echo '<span class="badge bg-warning text-dark">Menunggu</span>';
                                    }
                                    ?>
                                    </td>

            <td>
    <!-- BUTTON EDIT -->
        <div class="aksi-btn">
            <a href="edit.php?id=<?= $row['id_pendaftaran']; ?>"
            class="btn btn-warning btn-sm">
            Edit
            </a>

    <!-- BUTTON HAPUS -->
            <a href="hapus.php?id=<?= $row['id_pendaftaran']; ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin ingin menghapus data ini?')">
            Hapus
            </a>

            <br>

    <!-- BUTTON STATUS -->
            <a href="ubah_status.php?id=<?= $row['id_pendaftaran']; ?>&status=Lulus"
            class="btn btn-success btn-sm">
            Lulus
            </a>

            <a href="ubah_status.php?id=<?= $row['id_pendaftaran']; ?>&status=Tidak Lulus"
            class="btn btn-secondary btn-sm">
            Tidak Lulus
            </a>
            </td>
                </tr>

            <?php }
            }else{ ?>

            <tr>
    <td colspan="18" class="text-center py-5 fw-bold">
    Data tidak ditemukan
</td>
</tr>

<?php
}
?>


            </tbody>
        </table>

    </div>
</div>

<script>

setInterval(function(){

    fetch('tampil_sma.php')
    .then(response => response.text())
    .then(data => {

        let parser = new DOMParser();
        let htmlDoc = parser.parseFromString(data, 'text/html');

        let tabelBaru = htmlDoc.querySelector('#dataTabel').innerHTML;

        document.querySelector('#dataTabel').innerHTML = tabelBaru;

    });

}, 3000);

</script>

</body>
</html>