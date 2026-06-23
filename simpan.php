<?php
include 'koneksi.php';

if (
    empty($_POST['nisn']) ||
    empty($_POST['nama_lengkap']) ||
    empty($_POST['email']) ||
    empty($_POST['jenis_kelamin']) ||
    empty($_POST['no_hp']) ||
    empty($_POST['tempat_lahir']) ||
    empty($_POST['tanggal_lahir']) ||
    empty($_POST['asal_sekolah']) ||
    empty($_POST['id_sekolah']) ||
    empty($_POST['id_jurusan']) ||
    empty($_POST['alamat']) ||
    empty($_POST['tanggal_daftar'])
){
    header("Location: daftar.php");
    exit;
}

$nisn           = $_POST['nisn'];
if(!preg_match('/^[0-9]{10}$/', $nisn)){
    echo "
    <script>
        alert('NISN harus terdiri dari 10 digit angka!');
        window.history.back();
    </script>
    ";
    exit;
}
$cek_nisn = mysqli_query($conn,
    "SELECT * FROM pendaftaran WHERE nisn='$nisn'");

if(mysqli_num_rows($cek_nisn) > 0){
    echo "
    <script>
        alert('NISN sudah terdaftar!');
        window.history.back();
    </script>
    ";
    exit;
}
$nama_lengkap   = $_POST['nama_lengkap'];
$email          = $_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "
    <script>
        alert('Format email tidak valid!');
        window.history.back();
    </script>
    ";
    exit;
}
$jenis_kelamin  = $_POST['jenis_kelamin'];
$no_hp          = $_POST['no_hp'];
if(!preg_match('/^[0-9]{10,13}$/', $no_hp)){
    echo "
    <script>
        alert('Nomor HP harus 10 sampai 13 digit angka!');
        window.history.back();
    </script>
    ";
    exit;
}
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$asal_sekolah   = $_POST['asal_sekolah'];
$id_sekolah     = $_POST['id_sekolah'];
$id_jurusan     = $_POST['id_jurusan'];
$alamat         = $_POST['alamat'];
$tanggal_daftar = $_POST['tanggal_daftar'];

$query = "INSERT INTO pendaftaran
(
    nisn,
    nama_lengkap,
    email,
    jenis_kelamin,
    no_hp,
    tempat_lahir,
    tanggal_lahir,
    alamat,
    asal_sekolah,
    tanggal_daftar,
    id_sekolah,
    id_jurusan
)
VALUES
(
    '$nisn',
    '$nama_lengkap',
    '$email',
    '$jenis_kelamin',
    '$no_hp',
    '$tempat_lahir',
    '$tanggal_lahir',
    '$alamat',
    '$asal_sekolah',
    '$tanggal_daftar',
    '$id_sekolah',
    '$id_jurusan'
)";

if(mysqli_query($conn,$query))
{
    echo "
    <script>
    alert('Pendaftaran berhasil!');
    window.location='index.php';
    </script>
    ";
}
else
{
    echo mysqli_error($conn);
}
?>