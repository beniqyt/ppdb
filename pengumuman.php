<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cek Pengumuman PPDB</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="pengumuman.css">
</head>
<body>

    <div class="pengumuman-card">

        <div class="logo-container">

        <img src="img/logosmk.png"
         alt="Logo Sekolah"
         class="logo">

        <img src="img/logosma.png"
         alt="Logo PPDB"
         class="logo">

        </div>
        <h2 class="text-center mb-2">
            Cek Pengumuman PPDB
        </h2>

        <p class="text-center mb-4">
            Masukkan NISN untuk melihat hasil seleksi PPDB
        </p>

        <form action="hasil_pengumuman.php"
      method="POST"
      onsubmit="return validasiForm()">

            <div class="mb-3">

                <label class="mb-2 fw-semibold">
                    NISN
                </label>
                <!-- maxlength="10" → maksimal 10 karakter pattern="[0-9]{10}" → harus 10 digit angka required → wajib diisi -->
                <input type="text"
       id="nisn"
       name="nisn"
       class="form-control"
       maxlength="10"
       inputmode="numeric"
       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
    </div>

            <button class="btn btn-primary w-100">
                🔍 Cek Hasil Pengumuman
            </button>

        </form>

        <div class="text-center mt-4 footer-text">
            © 2026 PPDB Sekolah
        </div>

    </div>

    <script>

function validasiForm(){

    let nisn = document.getElementById("nisn").value;
    let error = document.getElementById("errorNisn");

    if(nisn.trim() == ""){

        error.classList.remove("d-none");

        return false;
    }

    error.classList.add("d-none");

    return true;
}

</script>
<script>
function validasiForm(){

    let nisn = document.getElementById("nisn").value.trim();

    // kosong
    if(nisn == ""){

        Swal.fire({
            icon: 'warning',
            title: 'NISN Kosong',
            text: 'Silakan masukkan NISN terlebih dahulu',
            confirmButtonColor: '#2563eb'
        });

        return false;
    }

    // bukan 10 digit
    if(nisn.length != 10){

        Swal.fire({
            icon: 'error',
            title: 'NISN Tidak Valid',
            text: 'NISN harus terdiri dari 10 digit angka',
            confirmButtonColor: '#2563eb'
        });

        return false;
    }

    return true;
}
</script>
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>