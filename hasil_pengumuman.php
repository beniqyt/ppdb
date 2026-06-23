<?php
include 'koneksi.php';

$nisn = $_POST['nisn'];
if(!preg_match('/^[0-9]{10}$/', $nisn)){
    echo "
    <script>
        alert('NISN harus terdiri dari 10 digit angka!');
        window.history.back();
    </script>
    ";
    exit;
}

$data = mysqli_query($conn,"
SELECT
    p.*,
    s.nama_sekolah,
    j.nama_jurusan
FROM pendaftaran p
JOIN sekolah s
ON p.id_sekolah = s.id_sekolah
JOIN jurusan j
ON p.id_jurusan = j.id_jurusan
WHERE p.nisn = '$nisn'
");

$d = mysqli_fetch_assoc($data);

if($d){
    if($d['id_sekolah'] == '1'){
        $logo = 'img/logosmk.png';
    }else{
        $logo = 'img/logosma.png';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengumuman PPDB</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="hasil_pengumuman.css">
</head>
<body class="bg-light">

<div class="result-container">

    <div class="result-card">

        <!-- LOGO -->
        <div class="text-center mb-3">
        <?php if($d){ ?>
        <img src="<?= $logo; ?>" class="logo-sekolah">
        <?php } ?>
        </div>

        <h1 class="result-title">
            Hasil Seleksi PPDB
            <?php if($d){ ?><?= $d['nama_sekolah']; ?><?php } ?>
        </h1>

        <?php if($d){ ?>

            <?php if($d['status'] == 'Lulus'){ ?>

    <div class="status-box success">
        🎉 Selamat! Anda dinyatakan LULUS
    </div>

<?php } elseif($d['status'] == 'Tidak Lulus'){ ?>

    <div class="status-box danger">
        Maaf, Anda BELUM LULUS
    </div>

<?php } else { ?>

    <div class="status-box warning">
        ⏳ Hasil seleksi masih MENUNGGU
    </div>

<?php } ?>
            

            <div class="data-box">

                <div class="data-item">
                    <span>Nama Lengkap</span>
                    <strong><?= $d['nama_lengkap']; ?></strong>
                </div>

                <div class="data-item">
                    <span>NISN</span>
                    <strong><?= $d['nisn']; ?></strong>
                </div>

                <div class="data-item">
                    <span>Pilihan Sekolah</span>
                    <strong><?= $d['nama_sekolah']; ?></strong>
                </div>

                <div class="data-item">
                    <span>Jurusan</span>
                    <strong><?= $d['nama_jurusan']; ?></strong>
                </div>

                <div class="data-item">
                    <span>Asal Sekolah</span>
                    <strong><?= $d['asal_sekolah']; ?></strong>
                </div>

                <div class="data-item">
                    <span>Status</span>

                    <?php if($d['status'] == 'Lulus'){ ?>
                    <span class="status-lulus">
                        Lulus
                    </span>
                    
                    <?php } elseif($d['status'] == 'Tidak Lulus'){ ?>
                    <span class="status-gagal">
                        Tidak Lulus
                    </span>
                    
                    <?php } else { ?>
                    <span class="status-menunggu">
                        Menunggu
                    </span>

                <?php } ?>

                </div>

            </div>

        <?php } else { ?>

            <div class="alert alert-danger text-center mt-4">
                Data tidak ditemukan!
            </div>

        <?php } ?>

        <div class="text-center mt-4">
            <a href="pengumuman.php" class="btn btn-primary px-4">
                Cek Lagi
            </a>
        </div>

    </div>

</div>

</body>
</html>