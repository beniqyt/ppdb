<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

include '../koneksi.php';

session_start();

$id     = $_GET['id'];
$status = $_GET['status'];

// Update status pendaftar
mysqli_query($conn, "
UPDATE pendaftaran
SET status='$status'
WHERE id_pendaftaran='$id'
");

// Ambil data pendaftar
$data = mysqli_query($conn, "
SELECT * FROM pendaftaran
WHERE id_pendaftaran='$id'
");

$d = mysqli_fetch_assoc($data);

$mail = new PHPMailer(true);

try {

    // Debug SMTP (sementara)
    $mail->SMTPDebug = 2;

    // Konfigurasi SMTP Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ramdhanalfatah@gmail.com';
    $mail->Password   = 'ntmbrgtwcncyvqgp'; // tanpa spasi
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Pengirim
    $mail->setFrom(
        'ramdhanalfatah@gmail.com',
        'PPDB SMK Insan Kamil Tartila'
    );

    // Cek email tujuan
    if (empty($d['email'])) {
        die('Email pendaftar kosong!');
    }

    // Penerima
    $mail->addAddress($d['email']);

    // Format email
    $mail->isHTML(true);

    $mail->Subject = 'PENGUMUMAN HASIL SELEKSI PPDB TAHUN AJARAN 2026/2027';

    $mail->Body = "
    <h2>Pengumuman PPDB</h2>

    <p>
    Berdasarkan hasil seleksi Penerimaan Peserta Didik Baru (PPDB)
    Tahun Ajaran 2026/2027, peserta dengan data berikut:
    </p>

    <ul>
        <li><b>Nama:</b> {$d['nama_lengkap']}</li>
        <li><b>NISN:</b> {$d['nisn']}</li>
        <li><b>Asal Sekolah:</b> {$d['asal_sekolah']}</li>
        <li><b>Tanggal Pendaftaran:</b> " . date('d-m-Y', strtotime($d['tanggal_daftar'])) . "</li>
    </ul>

    <p>Dinyatakan:</p>

    <h1>{$status}</h1>

    <p>
    Silakan membawa berkas persyaratan berikut ke sekolah:
    </p>

    <ul>
        <li>Fotokopi Ijazah SMP/MTs</li>
        <li>Fotokopi Rapor SMP/MTs</li>
        <li>Fotokopi Akta Kelahiran</li>
        <li>Fotokopi Kartu Keluarga</li>
        <li>Pas Foto 3x4 (3 lembar)</li>
    </ul>

    <p>
    Demikian pengumuman ini disampaikan.
    Terima kasih telah mendaftar di SMK Insan Kamil Tartila.
    </p>

    <br>

    <p>Kepala SMK Insan Kamil Tartila</p>

    <p><b>Ressti Zhahara Zuleika, S.Pd</b></p>

    <br>

    <p>
    Hubungi lebih lanjut:
    <br>
    0822-4198-3346
    <br>
    0831-2738-9409
    </p>
    ";

    $mail->send();

    $_SESSION['success'] = "Email berhasil dikirim";

} catch (Exception $e) {

    die("PHPMailer Error: " . $mail->ErrorInfo);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
