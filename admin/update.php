<?php
include '../koneksi.php';

// ==========================
// AMBIL DATA
// ==========================
$id = $_POST['id'] ?? '';
$redirect = $_POST['redirect'];
if(!is_numeric($id)){
    echo "ID tidak valid!";
    exit;
}
if($id == ''){
    echo "ID tidak ditemukan!";
    exit;
}

$nisn = $_POST['nisn'] ?? '';
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
// Validasi Email
if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $email)){
    echo "
    <script>
        alert('Email harus menggunakan format yang benar dan diakhiri .com!');
        window.history.back();
    </script>
    ";
    exit;
}
$jk = $_POST['jk'] ?? '';
$tempat = $_POST['tempat'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$hp = $_POST['hp'] ?? '';
$asal = $_POST['asal'] ?? '';
$id_jurusan = $_POST['id_jurusan'] ?? '';


// ==========================
// VALIDASI
// ==========================
if($nisn=='' || $nama=='' || $email=='' || $jk=='' || $asal=='' || $id_jurusan=='' || $tempat=='' || $tanggal==''){
    echo "Data wajib diisi semua! <br><a href='$redirect'>Kembali</a>";
    exit;
}


// ==========================
// QUERY UPDATE
// ==========================
$query = "UPDATE pendaftaran SET 
    nisn='$nisn',
    nama_lengkap='$nama',
    email='$email',
    jenis_kelamin='$jk',
    tempat_lahir='$tempat',
    tanggal_lahir='$tanggal',
    alamat='$alamat',
    no_hp='$hp',
    asal_sekolah='$asal',
    id_jurusan='$id_jurusan'
WHERE id_pendaftaran='$id'";

$result = mysqli_query($conn, $query);


// ==========================
// HASIL
// ==========================
if($result){
    header("location:$redirect");
}else{
    echo "Update gagal!";
}
?>