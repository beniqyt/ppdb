<?php
include '../koneksi.php';

$id = $_GET['id'];

// ambil id_sekolah dulu
$data = mysqli_query($conn,"
SELECT id_sekolah
FROM pendaftaran
WHERE id_pendaftaran='$id'
");

$d = mysqli_fetch_assoc($data);

// tentukan redirect
if($d['id_sekolah'] == 1){
    $redirect = 'tampil_smk.php';
}else{
    $redirect = 'tampil_sma.php';
}

// hapus data
mysqli_query($conn,"
DELETE FROM pendaftaran
WHERE id_pendaftaran='$id'
");

// kembali
header("location:$redirect");
exit;
?>