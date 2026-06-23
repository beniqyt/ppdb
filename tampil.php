<?php
include 'koneksi.php';

$query = "
SELECT
p.*,
    s.nama_sekolah,
    j.nama_jurusan
FROM pendaftaran p
JOIN sekolah s ON p.id_sekolah = s.id_sekolah
JOIN jurusan j ON p.id_jurusan = j.id_jurusan
WHERE 1=1
";

$params = [];
$types = "";

// 🔍 search nama
if(isset($_GET['cari'])){

    if(trim($_GET['cari']) == ''){
        echo "
        <script>
            alert('Masukkan nama terlebih dahulu!');
            window.location='tampil.php';
        </script>
        ";
        exit;
    }

    $query .= " AND nama_lengkap LIKE ?";
    $params[] = "%" . trim($_GET['cari']) . "%";
    $types .= "s";
}

// 🎯 filter sekolah
if(!empty($_GET['filter'])){
    $query .= " AND nama_sekolah = ?";
    $params[] = $_GET['filter'];
    $types .= "s";
}

// urutan
$query .= " ORDER BY id_pendaftaran DESC";

// prepare
$stmt = mysqli_prepare($conn, $query);

if(!$stmt){
    die("Query error: " . mysqli_error($conn));
}

// bind parameter kalau ada
if(!empty($params)){
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

// execute
mysqli_stmt_execute($stmt);

// ambil data
$data = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
    <style>
        mark{
    background:#2563EB !important;
    color:#fff !important;
    padding:3px 6px;
    border-radius:6px;
    font-weight:600;
}
@media (max-width:768px){

    h2{
        font-size:24px;
    }

    .card{
        padding:15px !important;
    }

    .table{
        font-size:14px;
    }

    .btn{
        width:100%;
    }

}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Pendaftar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4 text-center">
        Data Pendaftar PPDB
    </h2>

    <div class="mb-3">
    <a href="index.php" class="btn btn-outline-dark btn-sm">
        ⬅ Kembali
    </a>
</div>

    <div class="card shadow p-4">
        <form method="GET" class="row g-2 mb-3">

    <div class="col-md-4">
        <input type="text" name="cari" class="form-control"
        placeholder="Cari nama..."
        value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
    </div>

    <div class="col-md-3">
        <select name="filter" class="form-select">
            <option value="">-- Semua Sekolah --</option>
            <option value="SMA" <?= (isset($_GET['filter']) && $_GET['filter']=="SMA") ? "selected" : "" ?>>SMA</option>
            <option value="SMK" <?= (isset($_GET['filter']) && $_GET['filter']=="SMK") ? "selected" : "" ?>>SMK</option>
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
    </div>

</form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">

            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Pilihan Sekolah</th>
                    <th>Jurusan</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            if(mysqli_num_rows($data) == 0){echo "
            <tr><td colspan='7' class='text-center py-4'>❌ Data pendaftar tidak ditemukan
            </td>
            </tr>";
            }

            while($row = mysqli_fetch_assoc($data)){
            ?>

            <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($row['nisn']); ?></td>
    <td>
<?php
$nama = htmlspecialchars($row['nama_lengkap']);
if(!empty($_GET['cari'])){
    $cari = htmlspecialchars($_GET['cari']);
    $nama = preg_replace(
        "/(" . preg_quote($cari, '/') . ")/i",
        "<mark><b>$1</b></mark>",
        $nama
    );
}
echo $nama;
?>
</td>
    <td><?= htmlspecialchars($row['nama_sekolah']); ?></td>
    <td><?= htmlspecialchars($row['nama_jurusan']); ?></td>
    <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])); ?></td>
    <td>
        <?php
        if($row['status']=="Lulus"){
            echo "<span class='badge bg-success'>Lulus</span>";
        }elseif($row['status']=="Tidak Lulus"){
            echo "<span class='badge bg-danger'>Tidak Lulus</span>";
        }else{
            echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
        }
        ?>
    </td>
</tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>