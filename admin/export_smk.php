<?php
include '../koneksi.php';

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pendaftar_SMK.xls");
?>

<table border="1">
<tr>
    <th>No</th>
    <th>NISN</th>
    <th>Nama Lengkap</th>
    <th>Email</th>
    <th>Jenis Kelamin</th>
    <th>No HP</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Asal Sekolah</th>
    <th>Pilihan Sekolah</th>
    <th>Jurusan</th>
    <th>Tanggal Daftar</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

$query = mysqli_query($conn,"
    SELECT
        p.*,
        s.nama_sekolah,
        j.nama_jurusan
    FROM pendaftaran p
    JOIN sekolah s
    ON p.id_sekolah = s.id_sekolah
    JOIN jurusan j
    ON p.id_jurusan = j.id_jurusan
    WHERE p.id_sekolah = 1
    ORDER BY p.id_pendaftaran DESC
");

while($row = mysqli_fetch_assoc($query)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td style="mso-number-format:'\@';">
        <?= $row['nisn']; ?>
    </td>
    <td><?= $row['nama_lengkap']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['jenis_kelamin']; ?></td>
    <td style="mso-number-format:'\@';">
        <?= $row['no_hp']; ?>
    </td>
    <td><?= $row['tempat_lahir']; ?></td>
    <td><?= $row['tanggal_lahir']; ?></td>
    <td><?= $row['asal_sekolah']; ?></td>
    <td><?= $row['nama_sekolah']; ?></td>
    <td><?= $row['nama_jurusan']; ?></td>
    <td><?= $row['tanggal_daftar']; ?></td>
    <td><?= $row['status']; ?></td>
</tr>

<?php } ?>

</table>