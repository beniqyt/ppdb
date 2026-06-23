<?php
include '../koneksi.php';

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

$data = [
    "total_smk" => $total_smk,
    "laki_smk" => $laki_smk,
    "perempuan_smk" => $perempuan_smk,

    "total_sma" => $total_sma,
    "laki_sma" => $laki_sma,
    "perempuan_sma" => $perempuan_sma
];

echo json_encode($data);