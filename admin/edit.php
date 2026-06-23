<?php
include '../koneksi.php';

// AMBIL ID DARI URL
$id = $_GET['id'];

// AMBIL DATA DARI DATABASE
$data = mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE id_pendaftaran='$id'");

// UBAH MENJADI ARRAY
$d = mysqli_fetch_assoc($data);
$redirect = ($d['id_sekolah'] == '1')
    ? 'tampil_smk.php'
    : 'tampil_sma.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">Edit Data</h3>

        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $d['id_pendaftaran']; ?>">
            <input type="hidden" name="redirect" value="<?= $redirect; ?>">

            <div class="mb-3">
    <label>NISN</label>
    <input type="text"
           name="nisn"
           class="form-control"
           value="<?= $d['nisn']; ?>"
           maxlength="10"
           oninput="this.value=this.value.replace(/[^0-9]/g,'')">
</div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $d['nama_lengkap']; ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                    <input type="email"
           name="email"
           class="form-control"
           value="<?= $d['email']; ?>"
           pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$"
           title="Gunakan format email yang benar dan akhiri dengan .com"
           required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control">
                    <option <?= $d['jenis_kelamin']=="Laki-laki"?"selected":"" ?>>Laki-laki</option>
                    <option <?= $d['jenis_kelamin']=="Perempuan"?"selected":"" ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat" class="form-control" value="<?= $d['tempat_lahir']; ?>">
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal_lahir']; ?>">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= $d['alamat']; ?></textarea>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" 
                name="hp" 
                class="form-control" 
                maxlength="13"
                 oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>

            <div class="mb-3">
                <label>Asal Sekolah</label>
                <input type="text" name="asal" class="form-control" value="<?= $d['asal_sekolah']; ?>">
            </div>

            <div class="mb-3">
    <label>Jurusan</label>

    <select name="id_jurusan" class="form-control">

        <?php
        $jurusan = mysqli_query($conn,
        "SELECT * FROM jurusan");

        while($j = mysqli_fetch_assoc($jurusan)){
        ?>

        <option value="<?= $j['id_jurusan']; ?>"
        <?= ($d['id_jurusan'] == $j['id_jurusan']) ? 'selected' : ''; ?>>
            <?= $j['nama_jurusan']; ?>
        </option>

        <?php } ?>

    </select>
</div>

            <button class="btn btn-success w-100">Update</button>
        </form>
    </div>
</div>

</body>
</html>