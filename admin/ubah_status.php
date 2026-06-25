<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

include '../koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,
"UPDATE pendaftaran
SET status='$status'
WHERE id_pendaftaran='$id'");

$data = mysqli_query($conn,
"SELECT * FROM pendaftaran
WHERE id_pendaftaran='$id'");

$d = mysqli_fetch_assoc($data);

$mail = new PHPMailer(true);

try {

    // SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    // EMAIL GMAIL KAMU
    $mail->Username   = 'ramdhanalfatah@gmail.com';

    // APP PASSWORD DARI GOOGLE
    $mail->Password   = 'ntmbrgtwcncyvqgp';

    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // PENGIRIM
    $mail->setFrom(
        'ramdhanalfatah@gmail.com',
        'PPDB SMK Insan Kami Tartila'
    );

    // EMAIL TUJUAN
    $mail->addAddress($d['email']);

    // FORMAT EMAIL
    $mail->isHTML(true);
    $mail->SMTPDebug = 0;

    $mail->Subject = 'PENGUMUMAN HASIL SELEKSI PENERIMAAN PESERTA DIDIK BARU (PPDB) TAHUN AJARAN 2026/2027';

    $mail->Body = "
    <h2>Pengumuman PPDB</h2>

    <p>Berdasarkan hasil seleksi Penerimaan Peserta Didik Baru (PPDB) 
    Tahun Ajaran 2026/2027 yang meliputi verifikasi berkas, maka peserta dengan <b>Nama:</b> <b>".$d['nama_lengkap'].", Tanggal Pendaftaran: ".date('d-m-Y', strtotime($d['tanggal_daftar'])).", Asal Sekolah: ".$d['asal_sekolah'].", Dengan Nomor NISN : ".$d['nisn']."</b></p>

    <p>Dinyatakan:</p>

    <h1>".$status."</h1>

    <br>
    <p>Silakan membawa berkas-berkas syarat pendaftaran ke sekolah</p>
    <ul> 
    <li>Fotokopi ijazah SMP/MTs </li>
    <li>Fotokopi rapor SMP/MTs </li>
    <li>Fotokopi akte kelahiran </li>
    <li>Fotokopi kartu keluarga </li>
    <li>Pass foto 3x4 (3 lembar </li>
    </ul>
    </br>
    <p> Demikian pengumuman ini disampaikan, atas perhatiannya kami ucapkan, Terima kasih telah mendaftar.</p>

    <p>
    Kepala SMK Insan Kamil Tartila
    </p>

    <p>
    <b>Ressti Zhahara Zuleika, S.Pd
    </p>

    <br>

    <p>Hubungi lebih lanjut 0822-4198-3346 &</P <p>0831-2738-9409</p>
    
    <br>

    ";

    $mail->send();

} catch (Exception $e) {

    die("Email gagal dikirim: " . $mail->ErrorInfo);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;

?>
